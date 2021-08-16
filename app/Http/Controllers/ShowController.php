<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ShowController extends Controller{

    public function show(Request $request, $companyName ){
        $name = $companyName;
        return response("okay");
        $queries = Company::with('campaignes')->where('name',$name)->get(); // Eager Loading
        if($queries == null){
            return response("No company with this name-:".$companyName."dude");
        }
        return response($queries);

    }
}
