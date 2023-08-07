<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{

    public function index()
    {
        $withdrawals = Withdrawal::all();
        return view('admin.dashboard.employees.employeeWithdrawals.index' , compact('withdrawals'));
    }


    public function create()
    {
        return back();
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            Withdrawal::create([
                'employee_id' => $request->employee_id,
                'amount' => $request->amount,
                'date' => now(),
                'notes' => $request?->notes,
            ]);
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }


    public function show($id)
    {
        $withdrawal = Withdrawal::find($id);
        return view('admin.dashboard.employees.employeeWithdrawals.show', compact('withdrawal'));
    }


    public function edit($id)
    {
        return back();
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $withdrawal = Withdrawal::findOrFail($id);
            $withdrawal->amount = $request->amount;
            $withdrawal->notes = $request->notes;
            $withdrawal->save();

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
                $withdrawal = Withdrawal::find($id);
                $withdrawal->delete();
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
            $withdrawal = Withdrawal::findOrFail($id);
            $withdrawal->delete();


            if ($withdrawal) {
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
