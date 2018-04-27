<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class applicant extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'company_applicant';

    use LogsActivity;

    protected static $logName = '聯絡人資料';

    protected static $logOnlyDirty = true;

    protected $fillable = ['company_id', 'company_applicant_phone','company_applicant_mobile','company_applicant_email','company_applicant_dep','company_applicant_title','company_applicant_builder','applicant_name','applicant_note','company_applicant_email2'];
 
    protected static $logAttributes = ['company_id', 'company_applicant_phone','company_applicant_mobile','company_applicant_email','company_applicant_dep','company_applicant_title','company_applicant_builder','applicant_name','applicant_note','company_applicant_email2'];
}
