<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use View;

class EmailController extends Controller
{
    //

public function index()
    {

    	//從表單取得資料
        $from = ['email'=>'mozielin@gmail.com',
         'name'=>'EmailController',
         'subject'=>'加油好嗎'
        ];
        //填寫收信人信箱
        $to = ['email'=>'ryan@teamplus.com.tw',
       'name'=>'peter'];
        //信件的內容(即表單填寫的資料)
        $data = [
            'date'=>date('Y-m-d H:i:s')
        ];
        $time = Carbon::now();
                
        View::share('time', $time);
        //寄出信件
        \Mail::send('email.test', $data, function($message) use ($from, $to) {
        $message->from($from['email'], $from['name']);
        $message->to($to['email'], $to['name'])->subject($from['subject']);
        });

        

	}

}
