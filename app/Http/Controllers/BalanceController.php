<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BalanceController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'currency_id' => 'required|numeric',
            'receiver_id' => 'required|numeric',
            'description' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], UNPROCESSABLE_CONTENT);
        }

        $balance = Balance::create([
            'amount' => $request->input('amount'),
            'currency_id' => strtoupper($request->input('currency_id')),
            'description' => $request->input('description'),
            'receiver_id' => $request->input('receiver_id'),
            'sender_id' => Auth::id(),
        ]);

        $message = isArabicLang($request) ? 'تمت إضافة المعاملة بنجاح' : 'Transaction added successfully';
        return response()->json([
            'message' => $message,
            'balance' => $balance,
        ], CREATED);
    }
}

