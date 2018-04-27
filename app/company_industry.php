<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class company_industry extends Model
{
    protected $table = 'company_industry';

    use LogsActivity;

    protected static $logName = '客戶資料';

    protected static $logOnlyDirty = true;

   	protected $fillable = [
        'company_industry_name'
    ];

    protected static $logAttributes = ['company_industry_name'];

     public function company()
    {
        return $this->hasMany('App\company','com_industry_id','id');
    }
}
