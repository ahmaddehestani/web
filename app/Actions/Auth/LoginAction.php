<?php

namespace App\Actions\Auth;

use App\Http\Resources\HowIsLoginResource;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginAction
{
    use AsAction;

    public function handle()
    {
        $user = Auth::user();
        $data['token'] = $user?->createToken('MyApp')->plainTextToken;
        $data['user']=HowIsLoginResource::make(auth()->user());
        return $data;
    }
}
