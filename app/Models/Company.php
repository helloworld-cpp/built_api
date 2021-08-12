<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';

    // Relationship with the other tables //
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function tokens(){
        return $this->hasMany(Token::class,'company_id');
    }

    public function campaignes(){
        return $this->hasMany(Campaign::class);
    }


}
