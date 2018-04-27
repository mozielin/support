<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class manager extends Model
{

	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'company_user';

    //取消時間撮記
    public $timestamps = false;

    use LogsActivity;

    protected static $logName = '相關人員';

    protected static $logOnlyDirty = true;

    protected $fillable = ['company_id', 'user_id'];

    protected static $logAttributes = ['company_id', 'user_id'];

      public function company()
    {
        return $this->belongsToMany('App\company');
    }


}
