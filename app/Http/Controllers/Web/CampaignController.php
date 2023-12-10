<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompaignRequest;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function create()
    {
        return view('campaign');

   }
   public function store(CompaignRequest $request)
    {

        Campaign::create($request->validated());
        session()->flash('message', 'در خواست مشاوره شما با موفقیت ثبت شد.');
        return redirect()->route('campaign.create');

   }


}
