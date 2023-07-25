<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Resource;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('permission:'.CATEGORIES_PERMISSION)->only('index');
        $this->middleware('permission:'.CREATE_CATEGORY_PERMISSION)->only('create','store');
        $this->middleware('permission:'.READ_CATEGORY_PERMISSION)->only('show');
        $this->middleware('permission:'.UPDATE_CATEGORY_PERMISSION)->only('edit','update');
        $this->middleware('permission:'.DELETE_CATEGORY_PERMISSION)->only('destroy','deleteSelected');
    }
    public function index(): View|Factory|Application
    {
        if(request()->has('keyword')){
            $categories = Category::where('name','like','%'.request()->keyword.'%')->orderByDesc('id')->paginate(10);
            }else{
            $categories=Category::orderByDesc('id')->paginate(10);
            }

        return view('admin.dashboard.categories.index', compact( 'categories'));
    }


    public function create(): RedirectResponse
    {
        return back();
    }


    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $category = Category::create([
                'name' => $request->name,
                'description' => $request?->description,
            ]);

            if ($request->hasFile('avatar')) {
                $media = $category->addMediaFromRequest('avatar')
                    ->toMediaCollection(Category::CATEGORY_ICON_IMAGE_TAG);

                $category->icon = $media->id;
                $category->save();
            }
            if ($request->hasFile('banner')) {
                $media = $category->addMediaFromRequest('banner')
                    ->toMediaCollection(Category::CATEGORY_BANNER_IMAGE_TAG);

                $category->banner = $media->id;
                $category->save();
            }
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }



    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.dashboard.categories.show' , compact('category'));
    }


    public function edit($id)
    {
        return back();
    }


    public function update(Request $request, Category $category): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $category->update(
                [
                    'name' => $request->name,
                    'description' => $request?->description,
                ]
            );
            if ($request->hasFile('avatar')) {
                $media = $category->addMediaFromRequest('avatar')
                    ->toMediaCollection(Category::CATEGORY_ICON_IMAGE_TAG);

                $category->icon = $media->id;
                $category->save();
            }
            if ($request->hasFile('banner')) {
                $media = $category->addMediaFromRequest('banner')
                    ->toMediaCollection(Category::CATEGORY_BANNER_IMAGE_TAG);

                $category->banner = $media->id;
                $category->save();
            }
            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }



    public function destroy(int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            if(!$category->canDeleted()){
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.cannotDeleteCategory')
                ]);
            }else{
                $category->delete();
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
            $deletedCategories = [];
            $notDeletedCategories = [];
            foreach ($selectedData as $id) {
                $category = Category::find($id);
                if ($category) {
                    if ($category->canDeleted()) {
                        $deletedCategories[$category->id] = $category->name;
                        $category->delete();
                    } else {
                        $notDeletedCategories[$category->id] = $category->name;
                    }
                }
            }
            return Response()->json([
                'message' => [
                    'deletedCategories' => $deletedCategories,
                    'notDeletedCategories' => $notDeletedCategories,
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
