<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contributor;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContributorController extends Controller
{
    public function index()
    {
        $contributors = Contributor::orderByDesc('id')->get();
        return view('admin.dashboard.contributors.index', compact('contributors'));
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
            Contributor::create([
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
        $contributor = Contributor::find($id);
        $transactions = $contributor->transactions()->orderByDesc('id')->get();
        return view('admin.dashboard.contributors.show', compact('contributor', 'transactions'));
    }

    public function edit($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'shekels_balance' => 'nullable|numeric',
            'dollars_balance' => 'nullable|numeric',
            'dinars_balance' => 'nullable|numeric',
            'phone' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $contributor = Contributor::findOrFail($id);
            $contributor->name = $request->name;
            $contributor->shekels_balance = $request->shekels_balance;
            $contributor->dollars_balance = $request->dollars_balance;
            $contributor->dinars_balance = $request->dinars_balance;
            $contributor->phone = $request->phone;
            $contributor->save();

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
                $contributor = Contributor::find($id);
                $contributor->delete();
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
            $contributor = Contributor::findOrFail($id);
            $contributor->delete();

            if ($contributor) {
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
