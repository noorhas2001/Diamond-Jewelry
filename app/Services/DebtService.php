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
            'shekels_balance' => 'nullable|numeric',
            'dollars_balance' => 'nullable|numeric',
            'dinars_balance' => 'nullable|numeric',
            'weight' => 'nullable',
            'phone_number' => 'nullable',
        ]);

        if ($validator->fails()) {
            return error($validator->errors()->first());
        }

        try {
            Debt::create([
                'person_name' => $data['person_name'],
                'shekels_balance' => $data['shekels_balance'] ?? null,
                'dollars_balance' => $data['dollars_balance'] ?? null,
                'dinars_balance' => $data['dinars_balance'] ?? null,
                'debt_date' => now(),
                'is_debt_from_others' => $data['is_debt_from_others'] ?? null,
                'weight' => $data['weight'] ?? null,
                'phone_number' => $data['phone_number'],
            ]);

            return ['status' => 'success', 'message' => translate('messages.Added')];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
