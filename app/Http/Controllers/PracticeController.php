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
    public function check(Request $request){
        return response("Ok");

    }



}
