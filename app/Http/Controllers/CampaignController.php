<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Company;
use App\Models\Token;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CampaignController extends Controller{

    public function insert(Request $request){

        $request->validate([
            'company_id' => ['required','numeric','exists:companies,id'],
            'name' => ['required','regex:/^[a-zA-Z0-9 ]+$/'],
            'token_id' => ['nullable','numeric','exists:tokens,id'],
        ]);

        // checking if combination of token_id and company_id not exist in table:tokens //
        if($request->token_id){
            $queryCount = Token::where('id',$request->token_id)->where('company_id',$request->company_id)->count();
            if( ($queryCount) == 0 ){
                return response('Unsuccessful = "Combination of token_id and company_id not matches."');
            }
        }

        $request->request->add(['slug' => Campaign::createSlug($request->name,$request->company_id)]); //add slug field to the request array
        $insert = Campaign::create($request->all());

        return response($insert);

    }

}
