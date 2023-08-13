<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoldTransaction;
use App\Services\GoldTransactionService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GoldTransactionController extends Controller
{
    protected GoldTransactionService $goldTransactionService;

    public function __construct(GoldTransactionService $goldTransactionService)
    {
        $this->goldTransactionService = $goldTransactionService;
    }

    public function store(Request $request)
    {
        $result = $this->goldTransactionService->store($request->all());
        return $this->handleMessage($result);
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $transaction = GoldTransaction::find($id);
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
            $transaction = GoldTransaction::findOrFail($id);
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
