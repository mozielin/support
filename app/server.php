<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class server extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'company_server_info';

    use LogsActivity;

    protected static $logName = 'Server資料';

    protected static $logOnlyDirty = true;

    protected static $ignoreChangedAttributes = ['sync_at','updated_at'];

    protected $fillable = ['company_server_name', 'company_server_type','company_server_mac','company_server_interip','company_server_extip','company_server','company_server_builder','company_server_update','URL','company_version_num','com_builder_id','company_business_code','server_name','sync_at'];

 
    protected static $logAttributes = ['company_server_name', 'company_server_type','company_server_mac','company_server_interip','company_server_extip','company_server','company_server_builder','company_server_update','URL','company_version_num','com_builder_id','company_business_code','server_name'];
}
