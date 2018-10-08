<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIswitch;

class ToolController extends Controller
{
    public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index(){

       $data = APIswitch::first();
		
		return view('tool.tool_index')
			->with('data',$data); 
	}	

	public function APIswitch(){

    $APIswitch = APIswitch::first();

       switch ($APIswitch->mode) {
       	case 'API':
       		$APIswitch->mode = 'Email';
       		$APIswitch->save();
       		break;
       	case 'Email':
       		$APIswitch->mode = 'Both';
       		$APIswitch->save();
       		break;
       	case 'Both':
       		$APIswitch->mode = 'API';
       		$APIswitch->save();
       		break;

       }

    $data = APIswitch::first();
	
		return view('tool.tool_index')
			->with('data',$data); 
	}

  public function APItest(){
       
                $user = Auth::user();
                
                $account_list = json_encode([$user->email]);
                
                //API內容
                $content = '客服系統API通知測試。此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

                $msg_push = 'API通知測試';

                //API
                $client = new Client();
                $res = $client->request('POST', 'http://cloud.teamplus.com.tw/Community/API/SuperHubService.ashx?ask=sendMessage', [
                    'form_params' => [
                        'ch_sn' => '6104',
                        'api_key' => '726522eba8654146a7f9588fa0a97dfb',
                        'content_type' => '1',
                        'text_content' => $content,
                        'media_content' => 'API test',
                        'file_show_name' => '',
                        'msg_push' => $msg_push,
                        'account_list' => $account_list,
                    ]
                ]);

                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());
                //return dd($body);

                activity()->log('APItest');  
    
    return view('tool.tool_index'); 
  } 

  public function Mailtest(){

      $user = Auth::user();

      Mail::to($user->email)->send(new Mailtest($user));

      activity()->log('Mailtest');
    
    return view('tool.tool_index');

  }

  public function Bothtest(){

      $user = Auth::user();

      $account_list = json_encode([$user->email]);
                
                //API內容
                $content = '客服系統API通知測試。此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

                $msg_push = 'API通知測試';

                //API
                $client = new Client();
                $res = $client->request('POST', 'http://cloud.teamplus.com.tw/Community/API/SuperHubService.ashx?ask=sendMessage', [
                    'form_params' => [
                        'ch_sn' => '6104',
                        'api_key' => '726522eba8654146a7f9588fa0a97dfb',
                        'content_type' => '1',
                        'text_content' => $content,
                        'media_content' => 'API test',
                        'file_show_name' => '',
                        'msg_push' => $msg_push,
                        'account_list' => $account_list,
                    ]
                ]);

                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());
                //return dd($body);

                Mail::to($user->email)->send(new Mailtest($user));

                activity()->log('Bothtest');  
    
    return view('tool.tool_index');

  }


}
