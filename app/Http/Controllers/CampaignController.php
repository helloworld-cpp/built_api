<?php

namespace App\Http\Controllers;

use App\Event\CampaignCreated;
use App\Event\UserCreated;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\Token;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CampaignController extends Controller{

    public function insert(CampaignRequest $request){
        $insert = Campaign::create($request->all());
        return response(Campaign::where('id',$insert->id)->get(),201);
    }

}
