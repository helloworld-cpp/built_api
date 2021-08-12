<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Token extends Model
{
    use HasFactory;
    protected $table = 'tokens';
    protected $fillable = [
        'company_id',
        'name',
        'token',
    ];

    // Relationship with the other tables //
    public function companies(){
        return $this->belongsTo(Company::class);
    }

//    public function setNameAttribute($value){ // mutator example //
//        $this->attributes['name'] = strtolower($value);
//    }
//    public function getNameAttribute($value){ // accessor example //
//        return ucfirst($value);
//    }



}
