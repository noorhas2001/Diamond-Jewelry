<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Debt;
use App\Services\DebtService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DebtController extends Controller
{
    protected DebtService $debtService;

    public function __construct(DebtService $debtService)
    {
        $this->middleware('permission:'.DEBTS_ON_US_PERMISSION)->only('debtsOnUs');
        $this->middleware('permission:'.DEBTS_FOR_US_PERMISSION)->only('debtsForUs');
        $this->middleware('permission:'.CREATE_DEBT_PERMISSION)->only('create', 'store');
        $this->middleware('permission:'.UPDATE_DEBT_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:'.READ_DEBT_PERMISSION)->only('show');
        $this->middleware('permission:'.VERIFY_DEBT_PERMISSION)->only('verifiedDebt');
        $this->middleware('permission:'.DELETE_DEBT_PERMISSION)->only('destroy');
        $this->debtService = $debtService;
    }

    public function store_on_us(Request $request)
    {
        $request['is_debt_from_others'] = true;
        $result = $this->debtService->store($request->all());

        return $this->handleMessage($result);
    }

    public function store_for_us(Request $request)
    {
        $request['is_debt_from_others'] = false;
        $result = $this->debtService->store($request->all());

        return $this->handleMessage($result);
    }

    public function show($id)
    {
        $currencies = Currency::pluck('id', 'name');

        try {
            $debt = Debt::findOrFail($id);

            if ($debt->is_debt_from_others) {
                return view('admin.dashboard.debts.debtsOnUs.show', compact('debt', 'currencies'));
            } else {
                return view('admin.dashboard.debts.debtsForUs.show', compact('debt', 'currencies'));
            }
        } catch (Exception $e) {
            return back()->with('error', 'Failed to fetch debt details.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'person_name' => 'required|string',
            'amount' => 'required|numeric',
            'debt_date' => 'required|date',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $debt = Debt::findOrFail($id);
            $debt->update([
                'person_name' => $request->person_name,
                'amount' => $request->amount,
                'debt_date' => $request->debt_date,
                'currency_id' => $request->currency_id,
            ]);

            flash(translate('messages.Updated'))->success();
            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $debt = Debt::findOrFail($id);
            $debt->delete();

            return Response()->json([
                'status' => 'success',
                'message' => translate('messages.Deleted'),
            ]);
        } catch (Exception) {
            return Response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong'),
            ]);
        }
    }


    public function debtsOnUs()
    {
        $currencies = Currency::pluck('id', 'name');
        $debts = Debt::where('is_debt_from_others', true)->get();
        return view('admin.dashboard.debts.debtsOnUs.index', compact('debts', 'currencies'));
    }

    public function debtsForUs()
    {
        $currencies = Currency::pluck('id', 'name');
        $debts = Debt::where('is_debt_from_others', false)->get();
        return view('admin.dashboard.debts.debtsForUs.index', compact('debts', 'currencies'));
    }

    public function verifiedDebt($id): JsonResponse
    {
        try {
            $debt = Debt::find($id);
            if ($debt) {
                if ($debt->is_paid) {
                    return Response()->json([
                        'status' => 'error',
                        'message' => 'لا يمكن دفع الديون المدفوعة',
                    ]);
                } else {
                    $debt->update(['is_paid' => 1]);
                    return Response()->json([
                        'status' => 'success',
                        'message' => 'تمت عملية السداد بنجاح',
                    ]);
                }
            }

            return Response()->json([
                'status' => 'error',
                'message' => 'Not Found',
            ], 404);

        } catch (Exception $e) {
            return Response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $debt = Debt::find($id);
                $debt->delete();
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

    public function error($message = null): RedirectResponse
    {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }

    /**
     * @param  array|RedirectResponse  $result
     * @return RedirectResponse
     */
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
