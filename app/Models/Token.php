<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'token',
    ];



}
