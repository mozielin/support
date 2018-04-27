<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class functions extends Model
{
    protected $table = 'function';

    use LogsActivity;

    protected static $logName = '選配功能';

    protected static $logOnlyDirty = true;

    protected $fillable = ['function_name'];

    protected static $logAttributes = ['function_name'];
}
