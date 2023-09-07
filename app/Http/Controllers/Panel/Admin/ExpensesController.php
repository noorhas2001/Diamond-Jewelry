<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Services\ExpenseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{

    protected ExpenseService $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->middleware('permission:' . EXPENSES_PERMISSION)->only('expenses' ,'masa_expenses');
        $this->middleware('permission:' . CREATE_EXPENSE_PERMISSION)->only('create', 'store' ,'store_from_masa');
        $this->middleware('permission:' . READ_EXPENSE_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_EXPENSE_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_EXPENSE_PERMISSION)->only('destroy');
        $this->expenseService = $expenseService;
    }

    public function expenses()
    {
        $expenses = Expense::where('is_from_masa', false)->get();
        return view('admin.dashboard.expenses.employeesExpenses.index', compact('expenses'));
    }

    public function masa_expenses()
    {
        $expenses = Expense::where('is_from_masa', true)->get();
        return view('admin.dashboard.expenses.masaExpenses.index', compact('expenses'));
    }

    public function create()
    {
        return back();
    }


    public function store(Request $request)
    {
        $request['is_from_masa'] = false;
        $request['currency_id'] = 2;
        $result = $this->expenseService->store($request->all());

        return $this->handleMessage($result);
    }

    public function store_from_masa(Request $request)
    {
        $request['is_from_masa'] = true;
        $result = $this->expenseService->store($request->all());

        return $this->handleMessage($result);
    }

    public function show($id)
    {
        try {
            $expense = Expense::find($id);

            if ($expense->is_from_masa) {
                return view('admin.dashboard.expenses.masaExpenses.show', compact('expense'));
            } else {
                return view('admin.dashboard.expenses.employeesExpenses.show', compact('expense'));
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to fetch expense details.');
        }
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'nullable|exists:employees,id',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'currency_id' => 'required|integer|exists:currencies,id',
            'notes' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $expense = Expense::findOrFail($id);
            $expense->employee_id = $request->employee_id;
            $expense->description = $request?->description;
            $expense->amount = $request->amount;
            $expense->currency_id = $request->currency_id;
            $expense->notes = $request?->notes;
            $expense->save();

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
                $expense = Expense::find($id);
                $expense->delete();
            }
            return Response()->json([
                'status' => 'success',
                'message' => translate('messages.Deleted'),
            ]);
        } catch (Exception $ex) {
            return Response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong'),
            ]);
        }
    }

    public function destroy(int $id): JsonResponse
    {

        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();

            if ($expense) {
                return response()->json([
                    'status' => 'success',
                    'message' => translate('messages.Deleted'),
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong'),
            ]);
        }
    }

    public function error($message = null): RedirectResponse
    {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }

    public function handleMessage(array|RedirectResponse $result): RedirectResponse
    {
        if ($result['status'] === 'success') {
            flash($result['message'])->success();
            return back();
        } else {
            return $this->error($result['message']);
        }
    }
}
