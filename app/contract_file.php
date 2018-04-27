<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class contract_file extends Model
{
    protected $table = 'contract_file';

    use LogsActivity;

    protected static $logName = '合約檔案';

    protected static $logOnlyDirty = true;

    protected $fillable = ['file_name', 'contract_id','file_builder','file_updateby'];

 
    protected static $logAttributes = ['file_name', 'contract_id','file_builder','file_updateby'];
}
