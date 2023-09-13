<?php

namespace App\Services;

use App\Models\Contributor;
use App\Models\CurrencyDelar;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class TransactionService
{
    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'delar_id' => 'nullable|exists:currency_delars,id',
            'contributor_id' => 'nullable|exists:contributors,id',
            'transaction_type' => 'required|in:دفعة,استلام',
            'amount' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'date' => 'date',
            'notes' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        try {
            Transaction::create([
                'delar_id' => $data['delar_id'] ?? null,
                'contributor_id' => $data['contributor_id'] ?? null,
                'transaction_type' => $data['transaction_type'],
                'amount' => $data['amount'],
                'currency_id' => $data['currency_id'],
                'date' => now(),
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
