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

}
