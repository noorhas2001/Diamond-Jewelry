<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurrencyDelar;
use App\Models\Transaction;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(Request $request)
    {
        $result = $this->transactionService->store($request->all());
        return $this->handleMessage($result);
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $transaction = Transaction::find($id);
                $transaction->delete();
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
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            if ($transaction) {
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

    public function handleMessage(array | RedirectResponse $result): RedirectResponse
    {
        if ($result['status'] === 'success') {
            flash($result['message'])->success();
            return back();
        } else {
            return $this->error($result['message']);
        }
    }
}
