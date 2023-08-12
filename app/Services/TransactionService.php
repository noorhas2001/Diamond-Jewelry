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
            $transaction = Transaction::create([
                'delar_id' => $data['delar_id'] ?? null,
                'contributor_id' => $data['contributor_id'] ?? null,
                'transaction_type' => $data['transaction_type'],
                'amount' => $data['amount'],
                'currency_id' => $data['currency_id'],
                'date' => now(),
                'notes' => $data['notes'] ?? null,
            ]);

            $this->updateCurrencyBalance($transaction);

            return ['status' => 'success', 'message' => translate('messages.Added')];

        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    private function updateCurrencyBalance(Transaction $transaction)
    {
        $delarId = $transaction->delar_id ?? $transaction->contributor_id;

        if (!$delarId) {
            return;
        }

        $delarType = $transaction->delar_id ? CurrencyDelar::class : Contributor::class;
        $delar = $delarType::find($delarId);

        if (!$delar) {
            return;
        }

        $currencyField = $this->getCurrencyField($transaction->currency_id);

        if ($currencyField === null) {
            return;
        }

        $amount = $transaction->amount;

        if ($transaction->transaction_type == 'استلام') {
            $amount *= 1; // You can add any necessary calculations here
        } elseif ($transaction->transaction_type == 'دفعة') {
            $amount *= -1; // Multiply by -1 to subtract
        } else {
            return;
        }

        $delar->$currencyField += $amount;
        $delar->save();
    }

    private function getCurrencyField($currencyId)
    {
        switch ($currencyId) {
            case 1:
                return 'dollars_balance';
            case 2:
                return 'shekels_balance';
            case 3:
                return 'dinars_balance';
            default:
                return null;
        }
    }

    public function error($message = null): RedirectResponse
    {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }
}
