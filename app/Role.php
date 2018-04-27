<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use Zizaco\Entrust\EntrustRole;
use App\User;

class Role extends EntrustRole
{

	protected $table = 'roles';

	use LogsActivity;

    protected static $logName = 'Role資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['name', 'display_name','description'];
 
    protected static $logAttributes = ['name', 'display_name','description'];

	public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }


	
}