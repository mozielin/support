<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use \App\plan as planEloquent;

class plan extends Model
{
    protected $table = 'plan';

    use LogsActivity;

    protected static $logName = '方案資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];
    
}
