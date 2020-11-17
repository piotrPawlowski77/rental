<?php

namespace App\Models;

use App\rental\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use  UserPresenter; //to jest import trait user presenter

    public static $roles = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //user moze miec 1 lub wiele powiadomien
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    //user moze miec 1 lub wiele rezerwacji
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    //user moze wystawic 1 lub wiele opinii
    public function opinions()
    {
        return $this->hasMany('App\Models\Opinion');
    }

    //relacja z Photo: 1 do wielu (relacja polimorficzna)
    //user moze miec 1 lub wiele zdjec
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'photoable');
    }

    //kazdy user ma 1 role admin lub client
    public function role()
    {
        return $this->hasOne('App\Models\Role');
    }

    public function hasRole(array $roles)
    {
        foreach ($roles as $role)
        {
            //jesli w tab statycznej $roles istnieje rola jak w tab metody hasRole w BG. self to odwolanie do zm statycznej
            if(isset(self::$roles[$role]))
            {
                //jesli rola istnieje - przewrwij skrypt
                if(self::$roles[$role])
                    return true;
            }
            else
            {
                //jesli rola nie jest ustawiona w tab statycznej - zapisz role do zm statycznej => potrzebna relacja role()
                self::$roles[$role] = $this->role()->where('role_name', $role)->exists();

                //jesli rola istnieje - przewrwij skrypt
                if(self::$roles[$role])
                    return true;
            }
        }

        return false;
    }



}
