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
            'amount' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
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
                'notes' => $data['notes'] ?? null,
            ]);

            $debt = Debt::where('id', $data['person_id'])->first();

            if ($debt) {
                if ($data['transaction_type'] === 'سداد') {
                    $debt->weight -= $data['weight'];
                    $debt->amount -= $data['amount'];
                } elseif ($data['transaction_type'] === 'سحب') {
                    $debt->weight += $data['weight'];
                    $debt->amount += $data['amount'];
                }

                $debt->save();

                return ['status' => 'success', 'message' => translate('messages.Added')];
            } else {
                return ['status' => 'error', 'message' => 'Debt record not found'];
            }
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
