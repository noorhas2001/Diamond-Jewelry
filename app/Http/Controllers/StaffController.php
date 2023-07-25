<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . STAFFS_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_STAFF_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_STAFF_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_STAFF_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_STAFF_PERMISSION)->only('destroy', 'destroyShow');
    }
    public function index(): Factory|View|Application
    {

        $staffs = User::all();
        $roles = Role::pluck('id', 'name');


        return view('admin.dashboard.staffs.index', compact('staffs', 'roles'));
    }

    public function create(): RedirectResponse
    {
        return back();
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:users,phone',
            'role' => 'required'

        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $staff = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->input('password')),
                'phone' => $request->phone,
                'email_verified_at' => now(),
            ]);
            $staff->assignRole($request->input('role'));
            flash('تم الاضافة بنجاح')->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id): Factory|View|Application
    {
        $staff = User::find($id);
        $roles = Role::pluck('id', 'name');
        return view('admin.dashboard.staffs.show', compact('staff', 'roles'));
    }

    public function edit($id): RedirectResponse
    {
        return back();
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'phone' => 'required|unique:users,phone',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }

            $staff = User::find($id);
            $staff->update($input);

            $staff->roles()->sync([$request->input('role')]);
            flash('تم التحديث بنجاح')->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function destroy(int $id)
    {
        try {
            $staff = User::findOrFail($id);

            if (!$staff->canDeleted()) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messanslages.CannotDelete')
                ]);
            }

            $staff->delete();

            if ($staff) {
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
            $deletedStaffs = [];
            $notDeletedStaffs = [];
            foreach ($selectedData as $id) {
                $staff = User::find($id);
                if ($staff) {
                    if ($staff->canDeleted()) {
                        $deletedStaffs[$staff->id] = $staff->name;
                        $staff->delete();
                    } else {
                        $notDeletedStaffs[$staff->id] = $staff->name;
                    }
                }
            }
            return Response()->json([
                'message' => [
                    'deletedStaffs' => $deletedStaffs,
                    'notDeletedStaffs' => $notDeletedStaffs,
                ]
            ]);
        } catch (Exception $ex) {
            return response()->json([
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
}
