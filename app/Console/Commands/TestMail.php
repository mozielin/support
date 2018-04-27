<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class TestMail extends Command
{
    // 命令名稱
    protected $signature = 'testmail';

    // 說明文字
    protected $description = '[測試]mail';

    public function __construct()
    {
        parent::__construct();
    }

    // Console 執行的程式
    public function handle()
    {
         return redirect()->action('EmailController@index');
    }
}