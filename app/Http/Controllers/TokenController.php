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

        $request->validate([
            'company_id' => ['required','numeric','exists:companies,id'],
            'name' => ['required','regex:/^[^\s].[a-zA-Z0-9 ]+$/'],
        ]);

        // checking for any duplicate entry of name and company_id in the table tokens//
        $queryCount = Token::where('name',$request->name)->where('company_id',$request->company_id)->count();
        if($queryCount > 0){
            return response('Unsuccessful = "Unique combination of name and company_id already exists."',409);
        }

        $request->request->add(['token' => '']); //add token field to the request array
        $insert = Token::create($request->all());

        return response($insert,201);


    }
}
