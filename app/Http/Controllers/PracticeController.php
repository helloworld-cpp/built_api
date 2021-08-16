<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PracticeController extends Controller
{
    public function check(Request $request, $id ){

      //  $query = $request->query('lname');
        return response($id);

        $request->validate([
            'company_id' => ['required','numeric','exists:companies,id'],
           // 'name' => ['required','regex:/^[^\s].[a-zA-Z0-9 ]+$/'],
        ]);

        $queries = Company::with('campaignes')->get(); // Eager Loading

//        $temp = array(); // Lazy Loading
//        $queries = Company::all();
//        foreach ($queries as $query){
//            array_push($temp,$query);
//            array_push($temp,$query->campaignes()->get());
//        }

        return response()->json([
            //$temp,
            $queries,
        ]);

    }



}
