<?php

namespace App\Repositories\UserCompanyProfile;

use App\Models\UserCompanyProfile;
use App\Repositories\BaseRepository;

class UserCompanyProfileRepository extends BaseRepository implements UserCompanyProfileRepositoryInterface
{
    public function __construct(UserCompanyProfile $model)
    {
        parent::__construct($model);
    }

    public function getModel(): UserCompanyProfile
    {
        return parent::getModel();
    }
}
