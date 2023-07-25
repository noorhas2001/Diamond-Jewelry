<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Balance;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\LoginNotification;
use App\Notifications\ResetPasswordNotification;
use Exception;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @method success(array $array, string $string)
 */
class AuthController extends Controller
{

    private Otp $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $credentials = $request->only('email', 'password');
                    if (!Auth::attempt($credentials)) {
                        $fail(translate('validation.current_password'));
                    }
                }
            ]
        ]);


        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        $message = isArabicLang($request) ? 'لم يتم التحقق من عنوان بريدك الإلكتروني ..' : 'Your email address is not verified..';
        // Check if user's email has been verified
        if (!$user->email_verified_at) {
            return response()->json([
                'isVerified' => false,
                'message' => $message,
            ], BAD_REQUEST);
        }

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $user->notify(new LoginNotification());
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user_name' => $user->name, 
                'notification_count' => $user->unreadNotifications->count(),
            ]);
        }

        $message = isArabicLang($request) ? 'غير مصرح' : 'Unauthorized';
        return response()->json(['error' => $message], UNAUTHORIZED);
    }


    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'phone' => ['required', 'digits_between:10,20'],
            ]
        );

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            // ToDo:
        //            'plan_id' => get_setting('user_plan')
        ]);

        try {
            $user->notify(new EmailVerificationNotification());
        } catch (Exception $exception) {
        }

        return response()->json([
            'status' => true,
        ]);
    }


    public function emailVerification(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users',
                'otp' => 'required|max:6|exists:otps,token',
            ]
        );

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }
        $user_otp = $this->otp->validate($request->email, $request->otp);

        if (!$user_otp->status) {
            return response()->json(['error' => $user_otp], UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();

        $user->update(['email_verified_at' => now()]);

        return response()->json(['status' => true]);
    }


    public function sendEmailVerificationCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        try {
            $user->notify(new EmailVerificationNotification());

            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], SERVER_ERROR);
        }
    }


    public function forgotPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        try {
            $user->notify(new ResetPasswordNotification());
            return response()->json(['status' => true]);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], SERVER_ERROR);
        }
    }


    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
            'otp' => ['required', 'max:6', 'exists:otps,token'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $otpValidationResult = $this->otp->validate($request->email, $request->otp);
        if (!$otpValidationResult->status) {
            return response()->json(['error' => $otpValidationResult], UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->update(['password' => Hash::make($request->password)]);
        $user->tokens()->delete();

        return response()->json(['status' => true]);
    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
        ]);
    }


    public function editUserName(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',

                ]
            );

            if ($validator->fails()) {
                return $this->handleErrors($validator);
            } else {
                $user = User::find($request->user()->id);
                if ($user) {
                    $user->name = $request->name;
                    $user->save();
                }
            }

            $message = isArabicLang($request) ? 'تم تحديث الملف الشخصي' : 'Profile updated';

            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], SERVER_ERROR);
        }
    }

    public function editUserPhone(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'phone' => ['required', 'unique:users,phone,'.$request->user()->id, 'digits_between:10,20'],
                ]
            );

            if ($validator->fails()) {
                return $this->handleErrors($validator);
            } else {
                $user = User::find($request->user()->id);
                if ($user) {
                    $user->phone = $request->phone;
                    $user->save();
                }
            }

            $message = isArabicLang($request) ? 'تم تحديث الملف الشخصي' : 'Profile updated';

            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], SERVER_ERROR);
        }
    }


    public function editUserPassword(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|min:6|confirmed',
                ]
            );

            if ($validator->fails()) {
                return $this->handleErrors($validator);
            } else {
                $user = User::find($request->user()->id);
                if ($user) {
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }

            $message = isArabicLang($request) ? 'تم تحديث الملف الشخصي' : 'Profile updated';

            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], SERVER_ERROR);
        }
    }


    public function handleErrors($validator): JsonResponse
    {
        return response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], UNPROCESSABLE_CONTENT);
    }


    public function fcm_token_update(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'fcm_token' => ['required'],
                ]
            );

            if ($validator->fails()) {
                return $this->handleErrors($validator);
            }

            $user = auth('sanctum')->user();
            $exists = $user->personalFcmTokens()->where('token', '=', $request->fcm_token)->exists();
            if (!$exists) {
                $user->personalFcmTokens()->create([
                    'token' => $request->fcm_token,
                ]);
            }

            $message = isArabicLang($request) ? 'تم تحديث FCM بنجاح' : 'FCM Updated Successfully';
            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], SERVER_ERROR);
        }
    }

    public function getUserBalance(Request $request): JsonResponse
    {
        $user =  \auth()->user();

        return response()->json([
            'balance' => $user->balance,
        ]);
    }
}
