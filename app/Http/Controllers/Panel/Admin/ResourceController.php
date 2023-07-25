<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use App\Models\Resource;
use App\Models\User;
use App\Notifications\NewResourceNotification;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.RESOURCES_PERMISSION)->only('index');
        $this->middleware('permission:'.CREATE_RESOURCE_PERMISSION)->only('create', 'store');
        $this->middleware('permission:'.READ_RESOURCE_PERMISSION)->only('show');
        $this->middleware('permission:'.UPDATE_RESOURCE_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:'.DELETE_RESOURCE_PERMISSION)->only('destroy', 'deleteSelected');
    }

    public function index(): Factory|View|Application
    {

        $resources = Resource::orderByDesc('id')->get();
        $categories = Category::orderByDesc('id')->pluck('id', 'name');

        return view('admin.dashboard.resources.index', compact('resources', 'categories'));
    }


    public function create(): RedirectResponse
    {
        return back();
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'number_seats' => ['required'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $resource = Resource::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request?->description,
                'number_seats' => $request->number_seats,
                'added_by' => auth()->id(),
                'price_by_hour' => $request->price_by_hour,
                'price_by_day' => $request->price_by_day,
                'price_by_weak' => $request->price_by_weak,
                'price_by_month' => $request->price_by_month,
            ]);

            if ($request->hasFile('avatar')) {
                $media = $resource->addMediaFromRequest('avatar')
                    ->toMediaCollection(Resource::RESOURCE_IMAGE_TAG);

                $resource->thumbnail_img = $media->id;
                $resource->save();
            }
            $users = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($users, new NewResourceNotification($resource));
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }


    public function show($id
    ): Application|Factory|View {
        $resource = Resource::findOrFail($id);
        $categories = Category::pluck('id', 'name');
        $users = User::typeUser()->get();
        $payment_methods = PaymentMethod::pluck('id', 'name');
        $reservations = $resource->reservations;
        return view('admin.dashboard.resources.show', compact('resource',
            'categories',
            'reservations', 'users', 'payment_methods'));
    }


    public function edit($id): RedirectResponse
    {
        return back();
    }

    public function update(Request $request, Resource $resource): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'description' => ['string'],
            'number_seats' => ['required'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $resource->update(
                [
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'description' => $request?->description,
                    'number_seats' => $request->number_seats,
                    'added_by' => auth()->id(),
                    'price_by_hour' => $request->price_by_hour,
                    'price_by_day' => $request->price_by_day,
                    'price_by_weak' => $request->price_by_weak,
                    'price_by_month' => $request->price_by_month,

                ]
            );

            if ($request->hasFile('avatar')) {
                $media = $resource->addMediaFromRequest('avatar')
                    ->toMediaCollection(Resource::RESOURCE_IMAGE_TAG);

                $resource->thumbnail_img = $media->id;
                $resource->save();
            }

            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }

    public function destroy(int $id)
    {
        try {
            $resource = Resource::findOrFail($id);

            if (!$resource->canDeleted()) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.CannotDelete')
                ]);
            }

            $resource->delete();

            if ($resource) {
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


    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            $deletedResources = [];
            $notDeletedResources = [];
            foreach ($selectedData as $id) {
                $resource = Resource::find($id);
                if ($resource) {
                    if ($resource->canDeleted()) {
                        $deletedResources[$resource->id] = $resource->name;
                        $resource->delete();
                    } else {
                        $notDeletedResources[$resource->id] = $resource->name;
                    }
                }
            }
            return Response()->json([
                'message' => [
                    'deletedResources' => $deletedResources,
                    'notDeletedResources' => $notDeletedResources,
                ]
            ]);
        } catch (Exception $ex) {
            return $this->error();
        }

    }

    public function error(): RedirectResponse
    {
        flash(translate('messages.Wrong'))->error();
        return back();
    }


}
