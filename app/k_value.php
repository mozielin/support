<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class k_value extends Model
{
    
    protected $table = 'k_value';

    use LogsActivity;

    protected static $logName = '產出發版';

    protected static $logOnlyDirty = true;

    protected $fillable = ['k_value'];

    protected static $logAttributes = ['k_value'];
}
