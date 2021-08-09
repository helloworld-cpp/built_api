<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Token;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|alpha_num',
            'token_id' => 'required|num',
            //'exist:token,name,company_id',
        ]);

        if($validator->fails()){
            $messages = $validator->messages();
            return response()->json([
                $messages,
                'Unsuccessful' => "Oops wrong entry."
            ]);
        }



        $insert = [
            'slug' => SlugService::createSlug(Campaign::class, 'slug', $request->name),
            'company_id' => $request->company_id,
            'token_id' => $request->token_id,
            'name' => $request->name,
        ];

        Campaign::insertGetId($insert);

        return response()->json([
            'success' => "Greate! created successfully."
        ]);


    }
}
