<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = ['photoable_type', 'photoable_id', 'path'];

    //relacja polimorficzna
    public function photoable()
    {
        return $this->morphTo();
    }

    //zwraca sciezke bezwzgl do uploadowanych zdjec
    public function getPathAttribute($value)
    {
        //zwracam sciezke bezwzgledna
        return asset("storage/{$value}");
    }


    public function getStoragepathAttribute()
    {
        //zwracam sciezke wzgledna
        return $this->original['path'];
    }

    public static function imgRules($request, $type)
    {
        for ($i=0; $i <= count($request->file($type))-1; $i++)
        {
            $imgRules["$type.$i"] = 'image|max:200';
        }

        return $imgRules;
    }

}
