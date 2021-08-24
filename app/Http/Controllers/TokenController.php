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
    public function store(TokenRequest $request){
        $insert = Token::create($request->all());
        return response(Token::where('id',$insert->id)->get(),201);
    }
}
