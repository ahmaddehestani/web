<?php

namespace App\Http\Controllers\Api\V1\Auth;


use App\Actions\Auth\ConfirmOtpAction;
use App\Actions\Auth\ForgetPasswordAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\SetPasswordAction;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\ConfirmOtpRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Resources\HowIsLoginResource;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseApiController
{

    /**
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {
        return $this->successResponse(RegisterAction::run($request));
    }

    public function confirmOtp(ConfirmOtpRequest $request)
    {
        $success = ConfirmOtpAction::run($request->validated());
        if ($success) {
            return $this->successResponse($success, trans('auth.verified'));
        }
        return $this->errorResponse(trans('auth.otp_incorrect'), 403);
    }

    public function setPassword(SetPasswordRequest $request): JsonResponse
    {
        return $this->successResponse(UserResource::make(SetPasswordAction::run($request->validated())),
            trans('user.update_success')
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            return $this->successResponse(LoginAction::run(), trans('auth.login_successfully'));
        }
        return $this->errorResponse(trans('auth.password_incorrect'));
    }

    public function forgetPassword(ForgetPasswordRequest $request): JsonResponse
    {
        if ($request->input('mobile_prefix', '+98') === '+98') {
            $data = ForgetPasswordAction::run($request->validated());
            if ($data) {
                return $this->successResponse($data);
            }
            return $this->successResponse(trans('auth.not_confirmed'));
        }
        return $this->errorResponse(trans('auth.must_registered'));
    }

    public function HowIsLogin()
    {
            return $this->successResponse(HowIsLoginResource::make(auth()->user()->load('roles','services','tickets', 'UserCompanyProfile')));
    }
    public function logOut(){

        auth()->user()?->tokens()->delete();
        return $this->successResponse(trans('auth.logOut'));
    }
}
