<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class company_area extends Model
{
    protected $table = 'company_area';

    use LogsActivity;

    protected static $logName = '地區資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['area_name'];

 
    protected static $logAttributes = ['area_name'];

    //protected $fillable = [
    //    'company_type_name'
    //];

     public function company()
    {
        return $this->hasMany('App\company','company_area','id');
    }
}
