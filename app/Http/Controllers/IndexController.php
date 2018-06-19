<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use View;
use Session;
use App\User;
use App\group;
use App\patch;
use App\company;
use App\bulletin;


class IndexController extends Controller
{

	public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
   	public function index()
    {
        
        //把USER資料存入SESSION
    	Session::put('user',Auth::user());
    	//取得系統時間    
    	$time = Carbon::now();
        View::share('time', $time);
    	   	
    	$group = group::where('id','=',Auth::user()->user_group)->first();
        $user_group = $group->user_group_name;
        Session::put('group', $user_group);

        //取得URL版本資訊
        //$url = "http://cloud.teamplus.com.tw/Community/ver.txt" ;
        //$data = file_get_contents($url);
        //$version = substr($data, 4,6);
        
        //傳遞title給視圖
        $title = 'Home';
        View::share('title', $title);

        $data = bulletin::join('users','bulletin.builder','=','users.id')
                         ->select('bulletin.*','users.name')
                         ->orderby('bulletin.id','DESC')->first();   

         //doris
                        
        if(Auth::user() == '2')    {
           $data = bulletin::find('1'); 
        }       

        return view('home')
                    ->with('data',$data);

    }

}
