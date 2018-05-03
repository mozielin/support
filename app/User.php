<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Presenter\UserPresenter;


class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait; 
    use LogsActivity;
  

    protected $table = 'users';

    protected $presenter = 'App\Presenter\UserPresenter';

     //protected static $logOnlyDirty = true;

    protected static $logName = 'User資料';

    protected static $ignoreChangedAttributes = ['remember_token','login_at','updated_at'];

     protected $fillable = [
        'name', 'email', 'password'
    ];

    protected static $logAttributes = ['name', 'email'];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
