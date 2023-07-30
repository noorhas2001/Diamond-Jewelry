<?php

namespace App\Services;

use App\Models\Debt;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class DebtService
{
    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'person_name' => 'required|string',
            'amount' => 'required|numeric',
            'debt_date' => 'required|date',
            'currency_id' => 'required',
        ]);

        if ($validator->fails()) {
            return error($validator->errors()->first());
        }

        try {
            Debt::create([
                'person_name' => $data['person_name'],
                'amount' => $data['amount'],
                'debt_date' => $data['debt_date'],
                'is_debt_from_others' => $data['is_debt_from_others'] ?? null,
                'currency_id' => $data['currency_id'],
            ]);

            return ['status' => 'success', 'message' => translate('messages.Added')];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
