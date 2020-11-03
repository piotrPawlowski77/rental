<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'role_name'];

    //rola nalezy do jakiegos usera
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

}
