<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Carbon\Carbon;

use GuzzleHttp\Client;

class LetterController extends Controller
{
    public function letter(){

		$now = Carbon::now()->toDateString(); //29天後到期 

        if($now == '2018-06-20')    {
   
   			$data = User::find('2');
	

			        	//API
			        	//return $udata->name;
			        	$account_list = json_encode([$data->email]);
                        //API內容
			        	$content = 'Dear Doirs: Ryan有話跟妳說>> http://192.168.1.191/home';
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
			                'msg_push' => 'Letter',
			                'account_list' => $account_list,
			                ]
			            ]);

			            $body = $res->getBody();
			            $stringbody = string($body);
			            $body = json_decode($res->getBody());
			            //return dd($body);  
        }       
	}
}
