<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . EMPLOYEES_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_EMPLOYEE_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_EMPLOYEE_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_EMPLOYEE_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_EMPLOYEE_PERMISSION)->only('destroy', 'destroyShow');
    }

    public function index()
    {
        $employees = Employee::all();
        return view('admin.dashboard.employees.index', compact('employees'));
        dd($employees);
    }

    public function create()
    {
        return back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|unique:users,phone|max:20',
            'salary' => 'numeric',
            'bonuses' => 'numeric',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            Employee::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'salary' => $request->salary,
                'bonuses' => $request->bonuses,
            ]);
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('admin.dashboard.employees.show', compact('employee'));
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|unique:employees,phone,' . $id . ',id|max:20',
            'salary' => 'numeric',
            'bonuses' => 'numeric',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $employee = Employee::findOrFail($id);
            $employee->name = $request->name;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->bonuses = $request->bonuses;
            $employee->save();

            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $employee = Employee::find($id);
                $employee->delete();
            }
            return Response()->json([
                'status' => 'success',
                'message' => translate('messages.Deleted')
            ]);
        } catch (Exception $ex) {
            return Response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }
    }


    public function destroy(int $id): JsonResponse
    {

        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();


            if ($employee) {
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

    public function error($message = null): RedirectResponse
    {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }
}
