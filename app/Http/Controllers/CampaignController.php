<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\Token;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CampaignController extends Controller{

    public function insert(StoreUser $request){

        // checking if combination of token_id and company_id not exist in table:tokens //
        if($request->token_id){
            $queryCount = Token::where('id',$request->token_id)->where('company_id',$request->company_id)->count();
            if( ($queryCount) == 0 ){
                return response('Unsuccessful = "Combination of token_id and company_id not matches."',409);
            }
        }

        $request->request->add(['slug' => Campaign::createSlug($request->name,$request->company_id)]); //add slug field to the request array

        $insert = Campaign::create($request->all());

        return response($insert,201);

    }

}
