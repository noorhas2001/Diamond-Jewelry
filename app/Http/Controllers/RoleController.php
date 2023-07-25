<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . ROLES_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_ROLE_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_ROLE_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_ROLE_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_ROLE_PERMISSION)->only('destroy');
    }

    public function index(): Factory | View | Application
    {

        $roles = Role::all();
        $permissions = Permission::pluck('id', 'name');

        return view('admin.dashboard.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            flash('تم الاضافة بنجاح')->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id): View | Factory | Application
    {
        $role = Role::find($id);
        $permissions = Permission::pluck('id', 'name');
        $rolePermissions = Permission::join(
            "role_has_permissions",
            "role_has_permissions.permission_id",
            "=",
            "permissions.id"
        )
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('admin.dashboard.roles.show', compact('role', 'rolePermissions', 'permissions'));
    }

    public function edit($id): RedirectResponse
    {
        return back();
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->syncPermissions($request->input('permission'));
            $role->save();

            flash('تم التحديث بنجاح')->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }

    public function destroy($id): JsonResponse
    {
        try {


            $role = Role::findOrFail($id);

            if ($role) {
                if (get_setting(ADMIN_ROLE) == $id) {
                        return response()->json([
                        'status' => 'warning',
                        'message' => translate('messages.cannotDeleteRole')
                    ]);
                }
                else {
                    $role->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => translate('messages.Deleted')
                    ]);
                }
            }

            return redirect()->route('roles.index');
        } catch (Exception $e) {
            return Response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function error(): RedirectResponse
    {
        flash('حصل خطاء ما')->error();
        return back();
    }
}
