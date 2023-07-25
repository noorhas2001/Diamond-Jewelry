<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Resource;
use App\Models\Slider;
use Exception;
use Illuminate\Console\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Factory;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . SLIDERS_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_SLIDER_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_SLIDER_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_SLIDER_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_SLIDER_PERMISSION)->only('destroy');
    }
    public function index(): Factory|View|Application
    {
        $sliders = Slider::orderByDesc('id')->get();
        $resources = Resource::orderByDesc('id')->pluck('id', 'name');
        $categories = Category::orderByDesc('id')->pluck('id', 'name');
        $courses = Course::orderByDesc('id')->pluck('id', 'name');

        return view('admin.dashboard.sliders.index', compact('sliders', 'resources', 'categories', 'courses'));
    }


    public function create(): RedirectResponse
    {
        return back();
    }


    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return $this->error();
        } else {
            $slider = new Slider();
            $this->saveData($request, $slider);
            flash(translate('messages.Added'))->success();
        }
        return back();
    }


    public function show($id): Factory|View|Application
    {
        $slider = Slider::findOrFail($id);
        $resources = Resource::pluck('id', 'name');
        $categories = Category::pluck('id', 'name');
        $courses = Course::pluck('id', 'name');

        return view('admin.dashboard.sliders.show', compact('slider', 'resources', 'categories', 'courses'));
    }


    public function edit($id): RedirectResponse
    {
        return back();
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error();
        } else {
            $slider = Slider::findOrFail($id);
            $this->saveData($request, $slider);

            flash(translate('messages.Updated'))->success();
        }

        return back();
    }


    public function destroy(int $id): JsonResponse
    {

        try {
            $slider = Slider::findOrFail($id);
            $slider->delete();


            if ($slider) {
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
            foreach ($selectedData as $id) {
                $slider = Slider::find($id);
                $slider->delete();
            }
            return Response()->json([
                'status' => 'success',
                'message' => translate('sliderTranslation.SlidersDeleted')
            ]);
        } catch (Exception $ex) {
            return Response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }
    }


    public function error(): RedirectResponse
    {
        flash(translate('messages.Wrong'))->error();
        return back();
    }

    /**
     * @param  Request  $request
     * @param  Slider  $slider
     * @return void
     */
    public function saveData(Request $request, Slider $slider): void
    {
        $slider->title = $request->input('title');
        $slider->sub_title = $request->input('sub_title');
        $slider->description = $request->input('description');

        $link = [
            'type' => $request->input('link_option'),
            'id' => $request->input('id_option')
        ];
        $slider->link = json_encode($link);

        $slider->save();
    }
}
