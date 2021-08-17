<?php

namespace App\Http\Controllers;

use App\Event\UserCreated;
use App\Http\Requests\TokenRequest;
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
    public function insert(TokenRequest $request){

        // checking for any duplicate entry of name and company_id in the table tokens//

//        $queryCount = Token::where('name',$request->name)->where('company_id',$request->company_id)->count();
//        if($queryCount > 0){
//            return response('Unsuccessful = "Unique combination of name and company_id already exists."',409);
//        }


        $insert = Token::create($request->all());
        event(new UserCreated($insert));

        return response(Token::where('id',$insert->id)->get(),201);


    }
}
