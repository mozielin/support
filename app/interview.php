<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class interview extends Model
{
    protected $table = 'interview';

    use LogsActivity;

    use SoftDeletes;

    protected static $logName = '訪談紀錄';

    protected static $logOnlyDirty = true;

    protected $fillable = ['note','todo','text','company_id','builder','updater'];

    protected static $logAttributes = ['note','todo','text','company_id','builder','updater'];
}
