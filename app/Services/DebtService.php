<?php

namespace App\Services;

use App\Models\Debt;
use Exception;
use Illuminate\Support\Facades\Validator;

class DebtService
{
    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'person_name' => 'required|string',
            'amount' => 'nullable|numeric',
            'debt_date' => 'required|date',
            'currency_id' => 'nullable',
            'weight' => 'nullable',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return error($validator->errors()->first());
        }

        try {
            Debt::create([
                'person_name' => $data['person_name'],
                'amount' => $data['amount'] ?? null,
                'debt_date' => $data['debt_date'],
                'is_debt_from_others' => $data['is_debt_from_others'] ?? null,
                'currency_id' => $data['currency_id'] ?? null,
                'weight' => $data['weight'] ?? null,
                'phone_number' => $data['phone_number'],
            ]);

            return ['status' => 'success', 'message' => translate('messages.Added')];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
