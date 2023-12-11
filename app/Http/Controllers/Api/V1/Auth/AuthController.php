<?php

namespace App\Http\Controllers\Api\V1\Auth;


use App\Actions\User\Otp\SentOtpAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\ConfirmOtpRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Resources\HowIsLoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserOtp;
use Auth;
use Carbon\Carbon;
use http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseApiController
{

    /**
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {

        if ($request->input('mobile_prefix', '+98') === '+98') {
            $oldUser = User::where('mobile', $request->input('mobile'))->first();
            if (isset($oldUser['mobile_verified_at'])) {
                return trans('auth.registered');
            }
            if (!$oldUser) {
                return DB::transaction(function () use ($request) {
                    $user = new User;
                    $user->mobile_prefix = $request->mobile_prefix;
                    $user->mobile = (int)$request->mobile;
                    $user->save();
                    $data = SentOtpAction::run($user);
                    return $this->successResponse($data);
                });
            }
            $data = SentOtpAction::run($oldUser);
            return $this->successResponse($data);


        }

        return $this->errorResponse(trans('auth.prefix_incorrect'));
    }

    public function confirmOtp(ConfirmOtpRequest $request)
    {
        $userOtp = UserOtp::where('secret', $request['secret'])->latest()->first();
        if ($userOtp && $userOtp->otp === $request['otp']) {
            $userOtp->user()->update([
                'mobile_verified_at' => Carbon::now(),
            ]);
            $success['token'] = $userOtp->user->createToken('MyApp')->plainTextToken;
            return $this->successResponse($success, trans('auth.verified'));
        }
        return $this->errorResponse(trans('auth.otp_incorrect'), 403);
    }

    public function setPassword(SetPasswordRequest $request): JsonResponse
    {
        $user = auth()->user();
        $user = UpdateUserAction::run($user, $request->validated());
        return $this->successResponse(UserResource::make($user),
            trans('user.update_success')
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user?->createToken('MyApp')->plainTextToken;
            return $this->successResponse($data, trans('auth.login_successfully'));
        }
        return $this->errorResponse(trans('auth.password_incorrect'));
    }

    public function forgetPassword(ForgetPasswordRequest $request): JsonResponse
    {
        if ($request->input('mobile_prefix', '+98') === '+98') {
            $user = User::where('mobile', $request->input('mobile'))->first();
            if ($user) {
                if (isset($user['mobile_verified_at'])) {
                    $data = SentOtpAction::run($user);
                    return $this->successResponse($data);
                }
                return $this->errorResponse(trans('auth.not_confirmed'));
            }
        }
        return $this->errorResponse(trans('auth.must_registered'));
    }

    public function HowIsLogin(){
        return $this->successResponse(HowIsLoginResource::make(auth()->user()));
    }
}
