<?php

namespace App\Services;

use App\Models\GoldDelar;
use App\Models\GoldTransaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class GoldTransactionService
{
    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'gold_delar_id' => 'required|exists:gold_delars,id',
            'transaction_type' => 'required|in:دفعة,استلام',
            'item' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'workmanship' => 'required|numeric|min:0',
            'notes' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        try {
            GoldTransaction::create([
                'gold_delar_id' => $data['gold_delar_id'],
                'transaction_type' => $data['transaction_type'],
                'item' => $data['item'] ?? null,
                'weight' => $data['weight'],
                'workmanship' => $data['workmanship'],
                'notes' => $data['notes'] ?? null,
                'date' => now(),
            ]);

            return ['status' => 'success', 'message' => translate('messages.Added')];

        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function error($message = null): RedirectResponse
    {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }
}
