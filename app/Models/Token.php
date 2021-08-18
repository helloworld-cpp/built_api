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
    ];

    // Relationship with the other tables //
    public function companies(){
        return $this->belongsTo(Company::class);
    }


//    public function setTokenAttribute(){ // mutator to add token //
//        $this->attributes['token'] = (string) Str::uuid();
//    }




}
