<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . DEPOSITS_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_DEPOSIT_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_DEPOSIT_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_DEPOSIT_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_DEPOSIT_PERMISSION)->only('destroy');
    }

    public function index()
    {
        $deposits = Deposit::all();
        return view('admin.dashboard.deposits.index', compact('deposits'));
    }

    public function create()
    {
        return back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
            'currency_id' => 'required|integer|exists:currencies,id',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            Deposit::create([
                'amount' => $request->amount,
                'deposit_date' => now(),
                'notes' => $request?->notes,
                'currency_id' => $request->currency_id,
            ]);
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id)
    {
        $deposit = Deposit::find($id);
        return view('admin.dashboard.deposits.show', compact('deposit'));
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
            'currency_id' => 'required|integer|exists:currencies,id',

        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $deposit = Deposit::findOrFail($id);
            $deposit->amount = $request->amount;
            $deposit->notes = $request->notes;
            $deposit->currency_id = $request->currency_id;
            $deposit->save();

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
                $deposit = Deposit::find($id);
                $deposit->delete();
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
            $deposit = Deposit::findOrFail($id);
            $deposit->delete();

            if ($deposit) {
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
}
