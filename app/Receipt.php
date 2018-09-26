<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Receipt extends Model
{
    use SoftDeletes;

    use LogsActivity;

    protected $dates = ['deleted_at'];
    
    protected $table = 'receipt';

    protected static $logName = '發票資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['rcpdate', 'rcpnum','price','note','contract_id','company_id','builder'];
 
    protected static $logAttributes = ['rcpdate', 'rcpnum','price','note','contract_id','company_id','builder'];

}
