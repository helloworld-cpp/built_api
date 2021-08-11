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
        $queryCount = DB::table('tokens')->where('name','=',$request->name)->having('company_id','=',$request->company_id)->count();
        if($queryCount > 0){
            return response()->json([
                            'Unsuccessful' => "Unique combination of name and company_id already exists."
            ]);
        }

        $insert = Token::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'token' => (string) Str::uuid(),
        ]);

        return response()->json([
            'success' => "Great! created successfully.",
            $insert
        ]);

    }
}
