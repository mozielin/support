<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class seadmin extends Model
{

	use SoftDeletes;  

	use LogsActivity;

	use LogsActivity;

    protected $dates = ['deleted_at'];

    protected $table = 'seadmin';

    protected static $logName = 'TLC資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['company_name', 'company_tlc_start', 'company_tlc_end', 'builder'];

    protected static $logAttributes = ['company_name', 'company_tlc_start', 'company_tlc_end', 'builder'];



     public function seadmin()
    {
        return $this->belongsToMany('User');
    }
}
