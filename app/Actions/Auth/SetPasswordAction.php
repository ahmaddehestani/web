<?php

namespace App\Actions\Auth;

use App\Actions\User\UpdateUserAction;
use Lorisleiva\Actions\Concerns\AsAction;

class SetPasswordAction
{
    use AsAction;

    public function handle($request)
    {
        $user = auth()->user();
       return UpdateUserAction::run($user, $request);
    }
}
