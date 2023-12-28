<?php

namespace App\Repositories\UserOtp;

use App\Models\UserOtp;
use App\Repositories\BaseRepository;


class UserOtpRepository extends BaseRepository implements UserOtpRepositoryInterface
{
    public function __construct(UserOtp $model)
    {
        parent::__construct($model);
    }

    public function getModel(): UserOtp
    {
        return parent::getModel();
    }
    public function findLatest($value,$field): UserOtp
    {
      return  UserOtp::where($field, $value)->latest()->first();
    }
}
