<?php

namespace App\Services;

use App\Models\Debt;
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
            'amount' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
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
                'amount' => $data['amount'],
                'weight' => $data['weight'],
                'date' => now(),
                'notes' => $data['notes'] ?? null,
            ]);

            if ($data['transaction_type'] === 'سداد') {

                Debt::where('id', $data['person_id'])->decrement('weight', $data['weight']);
                Debt::where('id', $data['person_id'])->decrement('amount', $data['amount']);
            } elseif ($data['transaction_type'] === 'سحب') {
                Debt::where('id', $data['person_id'])->increment('weight', $data['weight']);
                Debt::where('id', $data['person_id'])->increment('amount', $data['amount']);
            }

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
