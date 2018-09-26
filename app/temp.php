<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class temp extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'temp';

    use LogsActivity;

    protected static $logName = '發版資料';

    protected static $logOnlyDirty = true;

    protected static $ignoreChangedAttributes = ['sync_at','updated_at'];

    protected $fillable = ['company_name', 'teampluscode','server_name','url','licensekey'];

    protected static $logAttributes = ['company_name', 'teampluscode','server_name','url','licensekey'];
}
