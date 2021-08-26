<?php

namespace App\Models;

use App\Event\UserCreated;
use App\Listener\CreateToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Token extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table = 'tokens';

    protected $fillable = [
        'company_id',
        'name',
    ];

    public static function boot() {
        parent::boot();
        static::creating(function($item) {
            $item->token = (string) Str::uuid();
        });
    }


    // Relationship with the other tables //
    public function companies(){
        return $this->belongsTo(Company::class);
    }




//    public function setTokenAttribute(){ // mutator to add token //
//        $this->attributes['token'] = (string) Str::uuid();
//    }




}
