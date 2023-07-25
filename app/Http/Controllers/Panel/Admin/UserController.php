<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . USERS_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_USER_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_USER_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_USER_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_USER_PERMISSION)->only('destroy');
    }
    public function index(): Factory|View|Application
    {
        $users = User::typeUser()->orderByDesc('id')->get();
        return view('admin.dashboard.users.index', compact('users'));
    }



    public function create(): RedirectResponse
    {
        return back();
    }


    public function edit($id): RedirectResponse
    {
        return back();
    }



    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->input('password')),
                'email_verified_at' => now(),
            ]);
            $user->save();

            flash('تم الاضافة بنجاح')->success();

            return back();
        } catch (Exception $e) {
            return $this->error();
        }
    }



    public function update(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->error();
        }

        try {
            $user->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'password' => Hash::make($request->input('password')),
                ]
            );


            $user->save();

            flash(translate('messages.Updated'))->success();

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }


    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            foreach ($selectedData as $id) {
                $user = User::find($id);
                $user->delete();
            }
            return Response()->json([
                'status' => 'success',
                'message' => translate('userTranslation.userDeleted')
            ]);
        } catch (Exception $ex) {
            return Response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }
    }


    public function destroy(int $id): JsonResponse
    {

        try {
            $user = User::findOrFail($id);
            $user->delete();


            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'message' => translate('messages.Deleted')
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }
    }


    public function show($id): Factory|View|Application
    {
        $user = User::findOrFail($id);
        return view('admin.dashboard.users.show', compact('user'));
    }



    public function error(): RedirectResponse
    {
        flash(translate('messages.Wrong'))->error();
        return back();
    }
}
