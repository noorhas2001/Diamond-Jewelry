<?php

namespace App\Services;

use App\Models\CurrencyDelar;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionService
{
    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'delar_id' => 'required|exists:currency_delars,id',
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
                'delar_id' => $data['delar_id'],
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
        $delar = CurrencyDelar::find($transaction->delar_id);
        if ($delar) {
            $currencyField = $this->getCurrencyField($transaction->currency_id);

            if ($transaction->transaction_type == 'دفعة') {
                $delar->$currencyField -= $transaction->amount;
            } elseif ($transaction->transaction_type == 'استلام') {
                $delar->$currencyField += $transaction->amount;
            }

            $delar->save();
        }
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
