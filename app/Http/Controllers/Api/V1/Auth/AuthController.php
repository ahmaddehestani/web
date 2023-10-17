<?php

namespace App\Http\Controllers\Api\V1\Auth;


use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\ConfirmOtpRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserOtp;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseApiController
{
    /**
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {

        if ($request->input('mobile_prefix','+98') === '+98') {
            $oldUser = User::where('mobile', $request->input('mobile'))->first();
            if(isset($oldUser['mobile_verified_at'])){
                return 'you register before please use remember password link';
            }
            if (!$oldUser) {
                return DB::transaction(function () use ($request) {
                    $user = new User;
                    $user->mobile_prefix = $request->mobile_prefix;
                    $user->mobile = (int)$request->mobile;
                    $user->save();
                    $data = $user->makeOtp();
                    return $this->successResponse($data);
                });
            }
            $data = $oldUser->makeOtp();
            return $this->successResponse($data);


        }

        return $this->errorResponse('your mobile prefix is incorrect ');
    }

    public function confirmOtp(ConfirmOtpRequest $request)
    {
        $userOtp = UserOtp::where('secret', $request['secret'])->latest()->first();
        if (is_null($userOtp->user->mobile_verified_at)) {
            if ($userOtp && ($userOtp->otp == $request['otp']) && $userOtp->try_count < 5) {
                $userOtp->user()->update([
                    'mobile_verified_at' => Carbon::now(),
                ]);
                $success['token'] = $userOtp->user->createToken('MyApp')->plainTextToken;
                return $this->successResponse($success, 'mobile verification successfully');
            }
            $try_count = $userOtp['try_count'];
            $userOtp->update(
                [
                    'try_count' => $try_count + 1,
                ]);
            return $this->errorResponse('otp is incorrect', 403);
        } else {
            return $this->errorResponse('this mobile verification before ', 403);
        }
    }

    public function setPassword(SetPasswordRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());
        return $this->successResponse(UserResource::make($user),
            trans('user.update_success')
        );
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = Auth::user();
           $data['token']= $user->createToken('MyApp')->plainTextToken;
           return $this->successResponse($data,'user login successfully');
        }
        return $this->errorResponse('mobile or password is incorrect');
    }
}
