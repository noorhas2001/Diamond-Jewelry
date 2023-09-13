<?php

namespace App\Services;

use App\Models\DebtTransaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class DebtTransactionService
{
    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'person_id' => 'required|exists:debts,id',
            'transaction_type' => 'required|in:سحب,سداد',
            'amount' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'date' => 'date',
            'notes' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        try {
            DebtTransaction::create([
                'person_id' => $data['person_id'],
                'transaction_type' => $data['transaction_type'],
                'amount' => $data['amount'] ?? null,
                'weight' => $data['weight'] ?? null,
                'date' => now(),
                'currency_id' => $data['currency_id'],
                'notes' => $data['notes'] ?? null,
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
