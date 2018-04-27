<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class bulletin extends Model
{
    use SoftDeletes;
    protected $table = 'bulletin';

    use LogsActivity;

    protected static $logName = '公告資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['bulletin_name', 'bulletin_content','builder','updateby'];

    protected static $logAttributes = ['bulletin_name', 'bulletin_content','builder','updateby'];
}
