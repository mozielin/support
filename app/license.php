<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class license extends Model
{

	use SoftDeletes;
    protected $table = 'license';

    use LogsActivity;

    protected static $logName = 'License';

    protected static $logOnlyDirty = true;

    protected $fillable = ['company_id','expire_at','lic_file','builder_id','status_id','start_at','lic_name','update_id'];

    protected static $logAttributes = ['company_id','expire_at','lic_file','builder_id','status_id','start_at','lic_name','update_id'];

     public function functions()
    {
        return $this->belongsToMany('App\functions','license_function','license_id','function_id');
    }
}
