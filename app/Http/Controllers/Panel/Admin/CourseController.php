<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Models\ReservationTime;
use App\Notifications\NewCourseNotification;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Reservation;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:'.COURSES_PERMISSION)->only('index');
        $this->middleware('permission:'.CREATE_CALENDAR_PERMISSION)->only('create', 'store');
        $this->middleware('permission:'.READ_COURSE_PERMISSION)->only('show');
        $this->middleware('permission:'.UPDATE_COURSE_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:'.DELETE_COURSE_PERMISSION)->only('destroy', 'deleteSelected');
    }

    public function index(): Factory|View|Application
    {
        $courses = Course::orderByDesc('id')->get();
        $resources = Resource::orderByDesc('id')->get();

        return view('admin.dashboard.courses.index', compact('courses', 'resources'));
    }

    public function create(): RedirectResponse
    {
        return back();
    }

    public function edit($id): RedirectResponse
    {
        return back();
    }

    public function show($id): Factory|View|Application
    {
        $course = Course::findOrFail($id);
        $subscriptions = $course->subscriptions;
        $users = User::typeUser()->orderByDesc('id')->get();
        $courseDays = json_decode($course->course_days);
        // Just need to Display in the Blade ( I well do it )
        $reservationTimes = $course->reservationTimes()->get();
        return view('admin.dashboard.courses.show',
            compact('course', 'subscriptions', 'users', 'courseDays', 'reservationTimes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'resource_id' => ['required'],
            'hours' => ['required'],
            'start_date' => ['required'],
            'number_seats' => ['required'],
            'lecture_hours' => ['required', 'integer'],
            'course_days' => 'required|array|min:1',
        ]);


        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $selectedDays = $request->input('course_days');
            $course_hours = $request->hours;
            $lecture_hours = $request->lecture_hours;
            $num_lectures = floor($course_hours / $lecture_hours);
            $num_lectures_mod = $course_hours % $lecture_hours;
            $num_week = floor(($num_lectures + $num_lectures_mod) / count($selectedDays));
            $num_week_days = ($num_lectures + $num_lectures_mod) % count($selectedDays);
            $startDate = Carbon::parse($request->start_date);

            $course = $this->createCourse($request, $course_hours, $lecture_hours, $selectedDays);

            $reservation = $this->createReservation($request, $course);

            $conflict = false;

            for ($i = 0; $i < $num_week; $i++) {
                if (($num_lectures_mod) && ($i == $num_week - 1)) {
                    foreach ($selectedDays as $day) {
                        if (end($selectedDays) == $day) {
                            $conflict = $this->checkAndCreateReservationTime($startDate, $day, $num_lectures_mod,
                                $reservation);
                        } else {
                            $conflict = $this->checkAndCreateReservationTime($startDate, $day, $lecture_hours,
                                $reservation);
                        }
                    }
                } else {
                    foreach ($selectedDays as $day) {
                        $conflict = $this->checkAndCreateReservationTime($startDate, $day, $lecture_hours,
                            $reservation);
                    }
                }
            }

            for ($i = 0; $i < $num_week_days; $i++) {
                if (($num_lectures_mod) && ($i == $num_week_days - 1)) {
                    $conflict = $this->checkAndCreateReservationTime($startDate,
                        $selectedDays[$i],
                        $num_lectures_mod,
                        $reservation);
                } else {
                    $conflict = $this->checkAndCreateReservationTime($startDate,
                        $selectedDays[$i],
                        $lecture_hours,
                        $reservation);
                }
            }

            if ($conflict) {
                DB::rollback();
                return $this->error(translate('messages.Overlaps'));
            }

            if ($request->hasFile('avatar')) {
                $media = $course->addMediaFromRequest('avatar')
                    ->toMediaCollection(Course::COURSE_IMAGE_TAG);
                $course->image = $media->id;
                $course->save();
            }

            $users = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($users, new NewCourseNotification($course));
            flash(translate('messages.Added'))->success();
            DB::commit();
            return back();
        } catch (Exception) {
            DB::rollback();
            return $this->error();
        }
    }


    public function update(
        Request $request,
        Course $course
    ): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'hours' => ['required'],
            'number_seats' => ['required', 'integer'],
            'lecture_hours' => ['required', 'integer'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $selectedDays = $request->input('course_days');
            $courseDays = json_encode($selectedDays);

            $course->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'hours' => $request->hours,
                    'number_seats' => $request->number_seats,
                    'lecture_hours' => $request->lecture_hours,
                    'description' => $request->description,
                    'course_days' => $courseDays,

                ]
            );

            if ($request->hasFile('avatar')) {
                $media = $course->addMediaFromRequest('avatar')
                    ->toMediaCollection(Course::COURSE_IMAGE_TAG);

                $course->image = $media->id;
                $course->save();
            }

            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }


    public
    function destroy(
        int $id
    ) {
        try {
            $course = Course::findOrFail($id);

            if (!$course->canDeleted()) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.CannotDelete')
                ]);
            }

            $course->delete();

            if ($course) {
                return response()->json([
                    'status' => 'success',
                    'message' => translate('messages.Deleted')
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }
    }

    public
    function deleteSelected(
        Request $request
    ) {
        try {
            $selectedData = $request->selectedData;
            $deletedCourses = [];
            $notDeletedCourses = [];
            foreach ($selectedData as $id) {
                $course = Course::find($id);
                if ($course) {
                    if ($course->canDeleted()) {
                        $deletedCourses[$course->id] = $course->name;
                        $course->delete();
                    } else {
                        $notDeletedCourses[$course->id] = $course->name;
                    }
                }
            }
            return Response()->json([
                'message' => [
                    'deletedCourses' => $deletedCourses,
                    'notDeletedCourses' => $notDeletedCourses,
                ]
            ]);
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }

    }


    public
    function error(
        $message = null
    ): RedirectResponse {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }

    /**
     * @param  Request  $request
     * @param  mixed  $course_hours
     * @param  mixed  $lecture_hours
     * @param  mixed  $selectedDays
     * @return mixed
     */
    public
    function createCourse(
        Request $request,
        mixed $course_hours,
        mixed $lecture_hours,
        mixed $selectedDays
    ): mixed {
        return Course::create([
            'name' => $request->name,
            'description' => $request?->description,
            'price' => $request->price,
            'added_by' => auth()->id(),
            'hours' => $course_hours,
            'lecture_hours' => $lecture_hours,
            'number_seats' => $request->number_seats,
            'start_date' => $request->start_date,
            'course_days' => json_encode($selectedDays), // Convert array to JSON
        ]);
    }

    /**
     * @param  Request  $request
     * @param  mixed  $course
     * @return Reservation
     */
    public
    function createReservation(
        Request $request,
        mixed $course
    ): Reservation {
        $reservation = new Reservation();
        $reservation->name = $request->input('name');
        $reservation->added_by = auth()->id();
        $reservation->resource_id = $request->input('resource_id');
        $reservation->course_id = $course->id;
        $reservation->isHasUser = ($reservation->user_id !== null);
        $reservation->payment_method_id = get_setting('cache_payment_method_id');
        $reservation->save();
        return $reservation;
    }

    /**
     * @param  Reservation  $reservation
     * @param  Carbon  $start_time
     * @param  Carbon  $end_time
     * @return bool
     */
    public
    function createReservationTime(
        Reservation $reservation,
        Carbon $start_time,
        Carbon $end_time
    ): bool {
        $reservationTime = new ReservationTime();
        $reservationTime->start_time = $start_time;
        $reservationTime->end_time = $end_time;
        $reservationTime->cost = 0;
        $reservationTime->reservation_id = $reservation->id;

        $existingReservations = checkConflict($reservation, $reservationTime);
        $reservationTime->save();

        if ($existingReservations->count() > 0) {
            return true; // Conflict detected
        }

        return false; // No conflict
    }


    /**
     * @param  Carbon  $startDate
     * @param  mixed  $day
     * @param  mixed  $lecture_hours
     * @param  Reservation  $reservation
     * @return array
     */
    public
    function checkAndCreateReservationTime(
        Carbon $startDate,
        mixed $day,
        mixed $lecture_hours,
        Reservation $reservation
    ): bool {
        while (true) {
            $startDay = strtolower($startDate->format('l'));
            if ($day == dayId($startDay)) {
                $start_time = $startDate->copy();
                $end_time = $start_time->copy()->addHours($lecture_hours);

                $conflict = $this->createReservationTime($reservation, $start_time, $end_time);
                if ($conflict) {
                    return true; // Conflict detected
                }
                $startDate->addDays(1);
                break;
            } else {
                $startDate->addDays(1);
            }
        }
        return false; // No conflict
    }
}



