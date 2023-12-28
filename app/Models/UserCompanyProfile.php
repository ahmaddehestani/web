<?php

namespace App\Models;

use App\Enums\TableUserCompanyProfileFieldPersonnelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_field',
        'company_name',
        'company_personnel_count',
        'company_address',
        'city',
        'province',
    ];
    protected $casts    = [
        'company_personnel_count' => TableUserCompanyProfileFieldPersonnelEnum::class,

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
