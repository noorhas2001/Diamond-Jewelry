<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . INVENTORY_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_INVENTORY_PERMISSION)->only('store');
        $this->middleware('permission:' . DELETE_INVENTORY_PERMISSION)->only('destroy');
    }

    public function index()
    {
        $inventories = Inventory::orderByDesc('id')->get();
        return view('admin.dashboard.inventories.index', compact('inventories'));
    }

    public function create()
    {
        return back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'equation' => 'required|numeric|min:0',
            'workmanship' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            Inventory::create([
                'item' => $request->item,
                'weight' => $request->weight,
                'equation' => $request->equation,
                'workmanship' => $request->workmanship,
                'total_weight' => $request->weight * $request->equation,
                'total_workmanship' => $request->weight * $request->workmanship,
            ]);
            flash(translate('messages.Added'))->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        return back();
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $inventories = Inventory::find($id);
                $inventories->delete();
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
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            if ($inventory) {
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
