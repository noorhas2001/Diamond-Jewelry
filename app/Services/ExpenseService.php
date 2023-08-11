<?php

namespace App\Services;

use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\Validator;

class ExpenseService
{

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'employee_id' => 'nullable',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'currency_id' => 'required|integer|exists:currencies,id',
        ]);

        if ($validator->fails()) {
            return error($validator->errors()->first());
        }

        try {
            Expense::create([
                'employee_id' => $data['employee_id'] ?? null,
                'description' => $data['description'],
                'amount' => $data['amount'],
                'is_from_masa' => $data['is_from_masa'] ?? null,
                'currency_id' => $data['currency_id'],
                'draw_date' => now(),
            ]);

            return ['status' => 'success', 'message' => translate('messages.Added')];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
