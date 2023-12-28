<?php

namespace App\Repositories\UserOtp;

use App\Models\UserOtp;
use App\Repositories\BaseRepositoryInterface;

interface UserOtpRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): UserOtp;
    public function findLatest($value,$field): UserOtp;
}
