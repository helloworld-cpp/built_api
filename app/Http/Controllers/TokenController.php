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
use Illuminate\Http\Response;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;


class TokenController extends Controller
{
    public function insert(Request $request){

        // validating the user input //

        $request->validate([
            'company_id' => ['required','numeric','exists:companies,id'],
            'name' => ['required','regex:/^[^\s].[a-zA-Z0-9 ]+$/'],
        ]);


//        $validator = Validator::make($request->all(),[
//                'company_id' => 'required|numeric|exists:companies,id',
//                'name' => 'required|regex:/^[^\s].[a-zA-Z0-9 ]+$/',
//        ]);
//
//
//        // if any validation fails this shows the error messages //
//
//                // if any typing failure happen by the user //
//                if($validator->fails()){
//                      return response()->json(
//                        $validator->messages(),);
//                }

                // checking for any duplicate entry of name and company_id in the table tokens//
                $queryCount = DB::table('tokens')->where('name','=',$request->name)->having('company_id','=',$request->company_id)->count();
                if($queryCount > 0){
                        return response()->json([
                            'Unsuccessful' => "Unique combination of name and company_id already exists."
                        ]);
                }

        /*--------------------------------------------------*/

            $token_key= (string) Str::uuid();
            $insert = [
                'company_id' => $request->company_id,
                'name' => $request->name,
                'token' => $token_key,
            ];
            Token::create($insert); //create row into the table:tokens
            return response()->json([
                $insert,
                'success' => "Great! created successfully."
            ]);



    }
}
