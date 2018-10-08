<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class company extends Model
{
	use SoftDeletes;

    use LogsActivity;

    protected $dates = ['deleted_at'];

    protected $table = 'company';

    protected static $logName = '客戶資料';

    protected $fillable = ['company_name', 'company_EIN','company_cel','comapny_url','company_population','company_capital','com_industry_id','com_type_id','com_plan_id','com_sales_id','com_builder_id','company_code','ver','company_create','company_status','note','deleter'];

 
    protected static $logAttributes = ['company_name', 'company_EIN','company_cel','comapny_url','company_population','company_capital','com_industry_id','com_type_id','com_plan_id','com_sales_id','com_builder_id','company_code','ver','company_create','company_status','note','deleter'];

    protected static $logOnlyDirty = true;



    public function com_type()
    {
        return $this->belongsTo('App\company_type');
    }

    public function com_industry()
    {
        return $this->belongsTo('App\company_industry');
    }

    public function manager()
    {
        return $this->belongsToMany('App\User','company_user','company_id','user_id');
    }

    public function applicant()
    {
        return $this->hasMany('App\applicant');
    }

    public function contract()
    {
        return $this->hasMany('App\contract','company_contract','id');
    }

    public function license()
    {
        return $this->hasMany('App\license');
    }

     public function cmanager()
    {
        return $this->hasMany('App\manager');
    }

      public function server()
    {
        return $this->hasMany('App\server','company_server','id');
    }

}
