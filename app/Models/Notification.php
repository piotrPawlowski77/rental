<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['shown']; //w BD nie bd wypelnial kolumny shown
    //bo auto sie wypelnia na 0

    protected $fillable = ['content', 'status', 'user_id'];

    //powiadomienie nalezy do jakiegos usera
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
