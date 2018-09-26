<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class version extends Model
{
    protected $table = 'version';

    use LogsActivity;

    protected static $logName = '版號對照';

    protected static $logOnlyDirty = true;

    protected $fillable = ['vernum','name'];

    protected static $logAttributes = ['vernum','name'];
}
