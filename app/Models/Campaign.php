<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Campaign extends Model{

    use HasFactory,Notifiable;
    protected $fillable = [
        'company_id',
        'token_id',
        'name',
    ];

    public static function boot() {
        parent::boot();
        static::creating(function($item) {
            $slug = self::createSlug($item->name, $item->company_id);
            $item->slug = $slug;
        });
    }

    // Relationship with the other tables //
    public function companies(){
        return $this->belongsTo(Company::class);
    }
    public function tokens(){
        return $this->belongsTo(Token::class);
    }


    // static method to create Slug //
    public static function createSlug($name,$company_id) { // generate company wise unique slug //
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;
        while (Campaign::where('company_id',$company_id)->whereSlug($slug)->exists()) { // loop to find the unique slug //
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }

}
