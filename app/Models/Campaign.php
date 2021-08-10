<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model{

    use HasFactory;
    protected $fillable = [
        'company_id',
        'token_id',
        'name',
        'slug',
    ];
    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
