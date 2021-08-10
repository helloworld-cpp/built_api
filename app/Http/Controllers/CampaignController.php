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

        // validating the user input //

            $validator = Validator::make($request->all(),[
                'company_id' => 'required|numeric|exists:companies,id',
                'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
                'token_id' => 'nullable|numeric|exists:tokens,id',
            ]);

        // if any validation fails this shows the error message //

                // if any typing failure happen by the user //
                if($validator->fails()){
                    $messages = $validator->messages();
                    return response()->json([
                        $messages,
                        'Unsuccessful' => "Oops wrong entry."
                    ]);
                }

                // if combination of token_id and company_id not exist in table:tokens //
                if($request->token_id){
                    $queryCount = DB::table('tokens')->where('id','=',$request->token_id)->having('company_id','=',$request->company_id)->count();
                    if( ($queryCount) == 0 ){
                        return response()->json([
                            'Unsuccessful' => "Combination of token_id and company_id not matches."
                        ]);
                    }
                }

        /*---------------------------------------------------------*/

            $insert = [
                'token_id' => $request->token_id,
                'company_id' => $request->company_id,
                'name' => $request->name,
                'slug'=> Campaign::createSlug($request->name,$request->company_id),
            ];

            Campaign::create($insert); //create row into the table:campaigns

            return response()->json([
                $insert,
                'success' => "Great! created successfully."
            ]);






    }

}
