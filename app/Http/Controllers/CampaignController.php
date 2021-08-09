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

class CampaignController extends Controller
{

    // it is a slug function //
    public function setSlug($name,$company_id) { // generate company wise unique slug //
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;
        while (Campaign::where('company_id',$company_id)->whereSlug($slug)->exists()) { // loop to find the unique slug //
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }


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
                    $query = DB::select( DB::raw("SELECT * FROM `tokens` WHERE `id` = ".$request->token_id." AND `company_id` = ".$request->company_id) );
                    if(! ($query)){
                        return response()->json([
                            'Unsuccessful' => "Combination of token_id and company_id not matches."
                        ]);
                    }
                }

        /*---------------------------------------------------------*/

        try{ // trying to insert into sql database "if successful it will respond"
            $insert = [
                'token_id' => $request->token_id,
                'company_id' => $request->company_id,
                'name' => $request->name,
                'slug'=> $this->setSlug($request->name,$request->company_id),
            ];

            Campaign::insertGetId($insert); //insert into the table:campaigns

            return response()->json([
                $insert,
                'success' => "Great! created successfully."
            ]);

        } catch(QueryException $ex){ // catching any exception in sql database //
                // if any unpredictable error happens in the database insertion or connectivity //
                return response()->json([
                    $ex->getMessage()
                ]);
        }




    }

}
