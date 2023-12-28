<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCompanyProfileRequest;
use App\Http\Requests\UpdateUserCompanyProfileRequest;
use App\Models\UserCompanyProfile;

class UserCompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserCompanyProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserCompanyProfile $userCompanyProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserCompanyProfileRequest $request, UserCompanyProfile $userCompanyProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserCompanyProfile $userCompanyProfile)
    {
        //
    }
}
