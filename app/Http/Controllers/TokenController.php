<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Token;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;


class TokenController extends Controller
{
    public function insert(Request $request){

        // validating the user input //
        $validator = Validator::make($request->all(),[
                'company_id' => 'required|numeric|exists:companies,id',
                'name' => 'required|regex:/^[^\s].[a-zA-Z0-9 ]+$/',
        ]);


        // if any validation fails this shows the error messages //

                // if any typing failure happen by the user //
                if($validator->fails()){
                    $messages = $validator->messages();
                    return response()->json([
                        $messages,
                        'Unsuccessful' => "Oops wrong entry."
                    ]);
                }

                // checking for any duplicate entry of name and company_id in the table tokens//
                    // running raw sql command on the laravel //
                if(DB::select( DB::raw("SELECT * FROM `tokens` WHERE `name` LIKE '".$request->name."' AND `company_id` = ".$request->company_id))){
                        return response()->json([
                            'Unsuccessful' => "Unique combination of name and company_id already exists."
                        ]);
                }

        /*--------------------------------------------------*/


        try { // trying to insert into sql database "if successful it will respond"
            $token_key= (string) Str::uuid();
            $insert = [
                'company_id' => $request->company_id,
                'name' => $request->name,
                'token' => $token_key,
            ];
            Token::insertGetId($insert); //insert into the table:tokens
            return response()->json([
                $insert,
                'success' => "Great! created successfully."
            ]);
        }catch(QueryException $ex){ // catching any exception in sql database //
                    // if any unpredictable error happens in the database insertion or connectivity //
                    return response()->json([
                        $ex->getMessage()
                    ]);
        }


    }
}
