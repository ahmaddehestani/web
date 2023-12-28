<?php

namespace App\Actions\UserCompanyProfile;

use App\Repositories\UserCompanyProfile\UserCompanyProfileRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserCompanyProfileAction
{
    use AsAction;
    public function __construct(private readonly UserCompanyProfileRepositoryInterface $repository)
    {
    }

    public function handle($userCompanyProfile, array $payload)
    {
        $this->repository->updateOrCreate($payload,['id' => $userCompanyProfile->id]);
        return $userCompanyProfile;
    }
}
