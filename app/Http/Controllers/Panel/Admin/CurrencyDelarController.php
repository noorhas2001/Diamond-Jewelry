<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurrencyDelar;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyDelarController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . CURRENCY_DELARS_PERMISSION)->only('index');
        $this->middleware('permission:' . CREAT_CURRENCY_DELAR_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_CURRENCY_DELAR_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_CURRENCY_DELAR_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_CURRENCY_DELAR_PERMISSION)->only('destroy');
    }

    public function index()
    {
        $currencyDelars = CurrencyDelar::orderByDesc('id')->get();
        return view('admin.dashboard.currency_delars.index', compact('currencyDelars'));
    }

    public function create()
    {
        return back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'shekels_balance' => 'nullable|numeric',
            'dollars_balance' => 'nullable|numeric',
            'dinars_balance' => 'nullable|numeric',
            'phone' => 'nullable',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            CurrencyDelar::create([
                'name' => $request->name,
                'shekels_balance' => $request->shekels_balance,
                'dollars_balance' => $request->dollars_balance,
                'dinars_balance' => $request->dinars_balance,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id)
    {
        $currency_delar = CurrencyDelar::find($id);
        $transactions = $currency_delar->transactions()->orderByDesc('id')->get();
        return view('admin.dashboard.currency_delars.show', compact('currency_delar', 'transactions'));
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'nullable',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $delar = CurrencyDelar::findOrFail($id);
            $delar->name = $request->name;
            $delar->phone = $request->phone;
            $delar->notes = $request->notes;
            $delar->save();

            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $delar = CurrencyDelar::find($id);
                $delar->delete();
            }
            return Response()->json([
                'status' => 'success',
                'message' => translate('messages.Deleted'),
            ]);
        } catch (Exception $ex) {
            return Response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong'),
            ]);
        }
    }

    public function destroy(int $id): JsonResponse
    {

        try {
            $delar = CurrencyDelar::findOrFail($id);
            $delar->delete();

            if ($delar) {
                return response()->json([
                    'status' => 'success',
                    'message' => translate('messages.Deleted'),
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong'),
            ]);
        }
    }

    public function error($message = null): RedirectResponse
    {
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }
}
