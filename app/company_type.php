<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class company_type extends Model
{
    
	protected $table = 'company_types';

    use LogsActivity;

    protected static $logName = '類別資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['company_type_name'];

    protected static $logAttributes = ['company_type_name'];

     public function company()
    {
        return $this->hasMany('App\company','com_type_id','id');
    }

}
