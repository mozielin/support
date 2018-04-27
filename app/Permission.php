<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Zizaco\Entrust\EntrustPermission;
use App\Role;

class Permission extends EntrustPermission
{

	protected $table = 'permissions';

	use LogsActivity;

    protected static $logName = 'Permission';

    protected static $logOnlyDirty = true;

    protected $fillable = ['name', 'display_name','description'];

 
    protected static $logAttributes = ['name', 'display_name','description'];

	public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
	
}
