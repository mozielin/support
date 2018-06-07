<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class switch extends Model
{
    protected $table = 'switch';

    use LogsActivity;

    protected static $logName = '通知開關';

    protected static $logOnlyDirty = true;

    protected $fillable = ['mode'];

    protected static $logAttributes = ['mode'];
}
