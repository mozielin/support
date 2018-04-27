<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class group extends Model
{
    protected $table = 'user_group';

    use LogsActivity;

    protected static $logName = '群組資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['user_group_name'];

    protected static $logAttributes = ['user_group_name'];


}
