<?php

namespace App\Actions\UserCompanyProfile;

use App\Repositories\UserCompanyProfile\UserCompanyProfileRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUserCompanyProfileAction
{
    use AsAction;

    public function __construct(private readonly UserCompanyProfileRepositoryInterface $repository)
    {
    }

    public function handle($payload)
    {
        return $this->repository->create($payload);
    }
}
