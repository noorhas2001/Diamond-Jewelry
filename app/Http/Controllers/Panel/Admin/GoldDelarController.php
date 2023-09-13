<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoldDelar;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoldDelarController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . GOLD_DELARS_PERMISSION)->only('index');
        $this->middleware('permission:' . CREAT_GOLD_DELAR_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_GOLD_DELAR_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_GOLD_DELAR_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_GOLD_DELAR_PERMISSION)->only('destroy');
    }

    public function index()
    {
        $goldDelars = GoldDelar::orderByDesc('id')->get();
        return view('admin.dashboard.gold_delars.index', compact('goldDelars'));
    }

    public function create()
    {
        return back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'total_weight' => 'nullable|numeric',
            'total_workmanship' => 'nullable|numeric',
            'phone_number' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            GoldDelar::create([
                'name' => $request->name,
                'total_weight' => $request->total_weight,
                'total_workmanship' => $request->total_workmanship,
                'phone_number' => $request->phone_number,
            ]);
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id)
    {
        $gold_delar = GoldDelar::find($id);
        $transactions = $gold_delar->goldTransactions()->orderByDesc('id')->get();
        return view('admin.dashboard.gold_delars.show', compact('gold_delar', 'transactions'));
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone_number' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $delar = GoldDelar::findOrFail($id);
            $delar->name = $request->name;
            $delar->phone_number = $request->phone_number;
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
                $delar = GoldDelar::find($id);
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
            $delar = GoldDelar::findOrFail($id);
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
