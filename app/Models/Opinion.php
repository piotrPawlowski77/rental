<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = ['content', 'rating', 'user_id'];

    //opinia nalezy do jakiegos usera
    public function user()
    {
        return $this->belongsTo('User');
    }

}
