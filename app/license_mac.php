<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class license_mac extends Model
{
    use Notifiable;
 
    use LogsActivity;

    protected static $logName = 'Mac資料';

    protected static $logOnlyDirty = true;
    
    protected $table = 'license_mac';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mac', 'license_id'
    ];

    protected static $logAttributes = ['mac', 'license_id'];
}
