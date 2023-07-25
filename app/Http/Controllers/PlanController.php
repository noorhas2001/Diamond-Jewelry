<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Plan;

use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:'.PLANES_PERMISSION)->only('index');
        $this->middleware('permission:'.CREATE_PLANE_PERMISSION)->only('create', 'store');
        $this->middleware('permission:'.READ_PLANE_PERMISSION)->only('show');
        $this->middleware('permission:'.UPDATE_PLANE_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:'.DELETE_PLANE_PERMISSION)->only('destroy');
    }

    public function index(): Factory|View|Application
    {
        if (request()->has('keyword')) {
            $plans = Plan::where('name', 'like', '%'.request()->keyword.'%')->paginate(10);
        } else {
            $plans = Plan::paginate(10);
        }


        return view('admin.dashboard.plans.index', compact('plans'));
    }

    public function create(): RedirectResponse
    {
        return back();
    }


    public function edit($id): RedirectResponse
    {
        return back();
    }


    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        try {
            Plan::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            flash('تم الاضافة بنجاح')->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }


    public function update(Request $request, Plan $plan): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $plan->update(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,

                ]
            );

            $plan->save();

            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }


    public function destroy($id): JsonResponse
    {
        try {


            $plan = Plan::findOrFail($id);

            if ($plan) {
                if (get_setting(ADMIN_PLAN) == $id) {
                        return response()->json([
                        'status' => 'warning',
                        'message' => translate('messages.cannotDeletePlan')
                    ]);
                }
                else {
                    $plan->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => translate('messages.Deleted')
                    ]);
                }
            }

            return redirect()->route('plans.index');
        } catch (Exception $e) {
            return Response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    public function show($id): Factory|View|Application
    {
        $plan = Plan::findOrFail($id);
        return view('admin.dashboard.plans.show', compact('plan'));
    }


    public function error(): RedirectResponse
    {
        flash(translate('messages.Wrong'))->error();
        return back();
    }
}
