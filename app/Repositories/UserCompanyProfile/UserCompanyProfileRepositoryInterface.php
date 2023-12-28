<?php

namespace App\Repositories\UserCompanyProfile;

use App\Models\UserCompanyProfile;
use App\Repositories\BaseRepositoryInterface;

interface UserCompanyProfileRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): UserCompanyProfile;
}
