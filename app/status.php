<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class status extends Model
{
    protected $table = 'status';

    use LogsActivity;

    protected static $logName = '各種狀態';

    protected static $logOnlyDirty = true;

    protected $fillable = ['status_name','status_class'];

    protected static $logAttributes = ['status_name','status_class'];
}
