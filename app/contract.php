<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class contract extends Model
{	
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $table = 'company_contract';

    use LogsActivity;

    protected static $logName = '合約資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['company_contract_date', 'company_contract_start','company_contract_end','company_contract_check','company_contract','company_contract_builder','contract_title','contract_status','contract_price','contract_quantity','contract_update','note'];

 
    protected static $logAttributes = ['company_contract_date', 'company_contract_start','company_contract_end','company_contract_check','company_contract','company_contract_builder','contract_title','contract_status','contract_price','contract_quantity','contract_update','note'];
}
