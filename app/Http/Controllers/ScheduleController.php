<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\patch;
use Excel;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response;
use App\Customer;
use Input;
use App\server;
use App\User;
use App\contract;
use App\license;
use App\company;
use DB;
use App\seadmin;

use App\APIswitch;

use GuzzleHttp\Client;

use App\Mail\LicenseAlert;

use App\Mail\ContractAlert;

use App\Mail\SyncDaemonAlert;

use App\Mail\TLCAlert;

use App\version;





class ScheduleController extends Controller
{

    public function matchtime(){

        $time = Carbon::now()->toDateString(); 

        \Storage::delete('/public/export/Total_'.$time.'.xls');

       
    }

	public function getuser(){

		$data = User::all();
		$count = User::all()->count();

			foreach ($data as $user) {
					
				$from = ['email'=>'mozielin@gmail.com',
         		'name'=>'ScheduleController',
         		'subject'=> $user->name
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

    public function servercatch(){

        $time = Carbon::now()->toDateString();

        $server = server::where('company_server_type','=','Team+')->get();
        //return dd($server);
            foreach ($server as $svdata ) {
                //return dd($company);
                //取出url
                $aurl = $svdata->URL;
                $update = server::find($svdata->id);                
                //return dd($aurl);
                //如果沒有網址就儲存no url
                if($aurl == null){
                    
                    //return dd($company);
                    
                    $syncver = 'NoURL';

                    $update->sync_ver = $syncver;
                    $update->sync_at = $time;
                    //return dd($company);
                    $update->save();
                }

                else{
                    //把原網址加上ver.txt
                    $burl = $aurl.'ver.txt';
                    //return dd($burl);
                    //宣告file_get_contents定義
                        $opts = array(  
                            'http'=>array(  
                                'method'=>"GET",  
                                'timeout'=>1, 
                                'ignore_errors'=> true)  
                        );  
                    $context = stream_context_create($opts);  
                    //去抓vet.txt檔
                    $data = @file_get_contents($burl, false, $context);
                    //error_reporting(0);
                    //判斷是否有抓到檔案
                    if($data !== false){
                        //抓ver.txt內的字元從11開始抓5字元
                        $version = substr($data, 11,5);
                        //純數字範本
                        $standerd = "/^([0-9]+)$/"; 
                            //比對是否為數字是就存
                            if(preg_match($standerd,$version)){
                                //return dd($version);
                                //$update = server::find($svdata->id);
                                //return dd($update);
                                $update->sync_ver = $version;
                                //return dd($update->ver);
                                $update->sync_at = $time;
                                $update->save();
                                //return dd($update->ver);  
                            }
                            else{//比對是否為數字不是就faild
                                //return dd($version);
                                //$update = server::find($svdata->id);
                                //return dd($update);
                                $version = 'SyncFail';
                                $update->sync_ver = $version;
                                //return dd($update->ver);
                                $update->sync_at = $time;
                                $update->save();
                                //return dd($update->ver);
                            }
                    }
  
                    else{//如果抓不到ver.txt再嘗試1次
                            $cnt=0;  
                        while ($cnt < 1 && ($data=@file_get_contents($burl, false, $context)===FALSE)) {
                            $cnt++ ;
                            }//還是抓不到就faild
                            //$update = server::find($svdata->id);
                            //return dd($update);
                            $update->sync_ver = 'Timeout';
                            //return dd($update->ver);
                            $update->sync_at = $time;
                            $update->save();
                            //return dd($update->ver);
                    }
                }
        
            }   //回去哪

                //先抓server資料
                $sdata = server::join('company','company_server_info.company_server','=','company.id')
                           ->where('company_server_type','=','Team+')
                           ->select('company.company_name','company_server_info.*')->get();

            //掃一遍license_function有SYNC挑出來存EXCEL
            //千呼萬喚使出來得SQL
                //      抓LIC表--結合--LIC&FUN關連表------用LIC表的ID-等於----LIC&FUN關連表---的LID-----
                $ldata = license::join('license_function','license.id','=','license_function.license_id')
                                ->join('company','license.company_id','=','company.id')
                               //->join('company_user','company_user.company_id','=','company.id')
                               //->join('users','company_user.company_id','=','users.id')
                                //神奇語法-排除重複且最新!
                                ->whereIn('license.id',function($query){
                                   $query->select(DB::raw('max(id)'))
                                         ->from('license')
                                         //排除重複公司
                                         ->groupBy('company_id'); 
                                })
                                //找出ID=SYNC的
                                ->where('function_id','=','3')
                                ->select('license.company_id','company.company_name','license_function.*')
                                ->get();

               //$udata = User::all();
               //$vdata = version::all();
                //return dd($sdata,$ldata);
               /* 產出EXCEL(把兩個產出結果分別放入兩張表)
                Excel::create('DailySyncVer_'.$time, function($excel) use($ldata,$sdata,$udata,$vdata) {

                    //第一張表server資訊
                    $excel->sheet('Server_Ver', function($sheet) use($sdata,$udata,$vdata) {

                    //$sheet->fromArray($sdata);
                    $sheet->loadView('export.Server_Ver')
                          ->with('udata',$udata)
                          ->with('sdata',$sdata)
                          ->with('vdata',$vdata);

                    })->store('xls',storage_path('/app/public/export'));

                    //第2張表有SYNCDAMON另外放
                    $excel->sheet('SyncDaemon', function($sheet) use($ldata,$udata) {

                    //$sheet->fromArray($ldata);

                    $sheet->loadView('export.SyncDaemon')
                          ->with('udata',$udata)
                          ->with('ldata',$ldata);

                    })->store('xls',storage_path('/app/public/export'));

                });
                */
               
                
                // "200"
                //echo $res->getHeader('content-type');
                // 'application/json; charset=utf8'
                //echo $res->getBody();


               //--撈出負責公司相關人員 寄信通知         
              // foreach ($ldata as $data) {
                   # code...
               // $adata = company::find($data->company_id)->manager()->get();
                //return dd($data); 

               // $company = ['company_name' => $data->company_name,
               // 'id'=>$data->company_id ];
                //return dd($syncdata);
               //  foreach ($adata as $edata) {
                    //return dd($company);
               // Mail::to($edata->email)->send(new SyncDaemonAlert($company));

                // }

               // \Session::flash('checkno_message', 'No Expire!');
               // return redirect()->action('SeController@index');
 
               //}
/*

            $user = User::where('user_group','=','3')->get();
            //return dd($user);
            foreach ($user as $udata) {

                $from = ['email'=> 'support@teamplus.com.tw',
                'name'=>'Team+ Support',
                'subject'=> '每日版本號撈取結果'];
                $to = ['email'=> $udata->email,
                'name'=> $udata->name];
                //信件的內容(即表單填寫的資料)
                $content = ['FYI'];
                //$time = Carbon::now();  

                //\View::share('time', $time);
                寄出信件
                \Mail::send('email.test',$content, function($message) use ($from, $to) {
                    $message->from($from['email'], $from['name']);
                    $message->to($to['email'], $to['name'])->subject($from['subject']);
                    $time = Carbon::now()->toDateString();
                    $path = storage_path('/app/public/export/DailySyncVer_'.$time.'.xls');
                    $message->attach($path);
                }); 

            }

            \Storage::delete('/public/export/DailySyncVer_'.$time.'.xls');*/
             
             //API測試    

           // $time = Carbon::now()->toDateString();
            //$path = storage_path('app/public/export/DailySyncVer_'.$time.'.xls');
            //return dd($path);
           // $type = pathinfo($path, PATHINFO_EXTENSION);
           // $exportdata = file_get_contents($path);
           // $apidata = base64_encode(file_get_contents($path));
           // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($exportdata);
            
           // $sdata = string($apidata);

             /*檔案上傳API
                $client = new Client();
                $res = $client->request('POST', 'http://192.168.1.25/API/IMService.ashx?ask=uploadFile', [
                    'form_params' => [
                        'account' => 'jasper',
                        'api_key' => '385DBAD3-A7CA-053F-5DDF-3CC6E4DFA347',
                        'file_type' => 'xls',
                        'data_binary' => $apidata,
                    ]
                ]);

                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());
                $filename = $body->FileName;
                //return dd($body->FileName);


                $client = new Client();
                $res = $client->request('POST', 'http://192.168.1.25/API/IMService.ashx?ask=sendChatMessage', [
                    'form_params' => [
                        'account' => 'jasper',
                        'api_key' => '385DBAD3-A7CA-053F-5DDF-3CC6E4DFA347',
                        'chat_sn' => '4',
                        'content_type' => '2',
                        'msg_content' => $filename,
                        'file_show_name' => 'DailySyncVer_'.$time.'.xls',
                    ]
                ]);

                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());

                 $client = new Client();
                $res = $client->request('POST', 'http://cloud.teamplus.com.tw/Community/API/IMService.ashx?ask=sendChatMessage', [
                    'form_params' => [
                        'account' => 'ryan@every8d.com.tw',
                        'api_key' => '3E436180-F58F-0A06-514A-F0616DAB5F58',
                        'chat_sn' => '8418',
                        'content_type' => '1',
                        'msg_content' => 'API Test',
                    ]
                ]);


                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());
                //return dd($body);*/
             \Session::flash('check_message', 'Check Done!');
             activity()->log('同步版號完成');
            return redirect()->action('ToolController@index');
        
    }

    public function contractcheck(){

         //29天後到期
        $time = Carbon::now()->addDays(90)->toDateString();

        //今天日期
        //$time = Carbon::now()->toDateString();
        //return dd($time);
        $contract = contract::join('company','company.id','=','company_contract.company_contract')
                            ->join('company_user','company_user.company_id','=','company.id')
                            ->join('users','users.id','=','company_user.user_id')
                            ->select('company_contract.*','users.name','users.email','company.company_name')
                            ->where('company_contract_end','=',$time)->get();
        //return dd($contract);
        if(!$contract->isEmpty()){
            activity()->log('合約到期檢查D90Y');
            return $this->contractalert($contract);
        }

        \Session::flash('checkno_message', 'No Expire!');
        activity()->log('合約到期檢查D90N'); 
        return redirect()->action('ToolController@index');

          
    }

    public function contractalert($contract){

    	$APIswitch = APIswitch::first();

    		switch ($APIswitch->mode) {
                case 'API':
                	//return dd($contract);
			        foreach ($contract as $udata) {
			        	//API
			        	//return $udata->name;
			        	$account_list = json_encode([$udata->email]);
                        //API內容
			        	$content = 'Hi,'.$udata->name.'，您於'.$udata->company_contract_start.'簽署之'.$udata->company_name.'即將於'.$udata->company_contract_end.'約滿到期，特發此提醒，敬請把握續約黃金時機。預祝您一切順利！此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';
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
			                'msg_push' => '合約到期通知',
			                'account_list' => $account_list,
			                ]
			            ]);

			            $body = $res->getBody();
			            $stringbody = string($body);
			            $body = json_decode($res->getBody());
			            //return dd($body);
                           
			        }
                       activity()->log('合約到期通知By_API');       
                    break;

                case 'Email':

                	foreach ($contract as $udata) {
			        	
			            //mail# code...   
			            Mail::to($udata->email)->send(new ContractAlert($udata));          
			        }

                    activity()->log('合約到期通知By_Mail'); 
                    
                    break;

                case 'Both':
                	        	//return dd($contract);
			        foreach ($contract as $udata) {
			        	//API
			        	//return $udata->name;
			        	$account_list = json_encode([$udata->email]);
			        	//信件的內容(即表單填寫的資料)
                        //API內容
			        	$content = 'Hi,'.$udata->name.'，您於'.$udata->company_contract_start.'簽署之'.$udata->company_name.'即將於'.$udata->company_contract_end.'約滿到期，特發此提醒，敬請把握續約黃金時機。預祝您一切順利！此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';
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
			                'msg_push' => '合約到期通知',
			                'account_list' => $account_list,
			                ]
			            ]);

			            $body = $res->getBody();
			            $stringbody = string($body);
			            $body = json_decode($res->getBody());
			            //return dd($body);
			            //mail# code...   
			              //寄出信件

                		Mail::to($udata->email)->send(new ContractAlert($udata));
			             
			        }

                    activity()->log('合約到期通知BOTH'); 
         
                    break;

            } 
        
        \Session::flash('check_message', 'Check Complete!');
        return redirect()->action('ToolController@index');
    }

    public function licensecheck(){
        //30天後到期
        $time = Carbon::now()->addDays(30)->toDateString();
        //今天到期
        //$time = Carbon::now()->toDateString();
                //return dd($time);
        $license = license::join('company','company.id','=','license.company_id')
                            ->join('company_user','company_user.company_id','=','company.id')
                            ->join('users','users.id','=','company_user.user_id')
                            ->select('license.*','users.name','users.email','company.company_name') 
                            ->where('expir_at','=',$time)->get();
        //return dd($license);
        if(!$license->isEmpty()){
            activity()->log('LIC到期檢查D30Y');
            return $this->licensealert($license);
        }
        \Session::flash('checkno_message', 'No Expire!');
        activity()->log('LIC到期檢查D30N');
        return redirect()->action('ToolController@index');

    }

     

    public function licensealert($license){

    	$APIswitch = APIswitch::first();

    	switch ($APIswitch->mode) {
    		case 'API':
    			foreach ($license as $udata) {

        		$account_list = json_encode([$udata->email]);
                //API內容
        		$content = $udata->company_name.'License授權時間將於'.$udata->expir_at.'到期，特發此提醒，如需申請展延，敬請提早洽談續約事宜並預留申請作業時間。預祝您一切順利！此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

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
                        'msg_push' => 'LicenseKey到期通知',
                        'account_list' => $account_list,
                    ]
                ]);

                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());

               }
                    activity()->log('LIC到期通知By_API');
    			break;

    		case 'Email':
    			foreach ($license as $udata) {
    				//mail# code...
    				Mail::to($udata->email)->send(new LicenseAlert($udata));
    			}
                    activity()->log('LIC到期通知By_Mail');
    			break;

    		case 'Both':
    			foreach ($license as $udata) {

        		$account_list = json_encode([$udata->email]);
                //API內容
        		$content = $udata->company_name.'License授權時間將於'.$udata->expir_at.'到期，特發此提醒，如需申請展延，敬請提早洽談續約事宜並預留申請作業時間。預祝您一切順利！此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

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
                        'msg_push' => 'LicenseKey到期通知',
                        'account_list' => $account_list,
                    ]
                ]);

                $body = $res->getBody();
                $stringbody = string($body);
                $body = json_decode($res->getBody());
                # code...   
            //mail

                Mail::to($udata->email)->send(new LicenseAlert($udata));
             
               }
                activity()->log('LIC到期通知BOTH');
    			break;

    	}

        \Session::flash('check_message', 'Check Complete!');
        return redirect()->action('ToolController@index');

    }

    public function licenseend(){

        $time = Carbon::now()->toDateString();
        //return dd($time);
        $license = license::join('company','company.id','=','license.company_id')
                            ->join('users','company.com_sales_id','=','users.id')
                            ->select('license.*','users.name','users.email','company.company_name') 
                            ->where('expir_at','<',$time)->get();
        //return dd($license);
        foreach ($license as $udata) {
                # code...   
                $udata->status_id = "17";
                
                $udata -> save();
                activity()->log($udata->id.'LIC到期自動轉失效');
               }

        $contract = contract::join('company','company.id','=','company_contract.company_contract')
                            ->join('company_user','company_user.company_id','=','company.id')
                            ->join('users','users.id','=','company_user.user_id')
                            ->select('company_contract.*','users.name','users.email','company.company_name')
                            ->where('company_contract_end','<',$time)->get();

         foreach ($contract as $cdata) {
                # code...   
                $cdata->contract_status = "4";
                
                $cdata -> save();
                activity()->log($cdata->id.'合約到期自動轉失效');
               }

    }

     public function tlccheck(){
        //30天後到期
        $time = Carbon::now()->toDateString();
        //----取得系統時間---加減(現在時間1天前)--轉為日期去掉分秒
        $alerttime = Carbon::now()->addDays(14)->toDateString();
        //$alerttime = Carbon::now()->modify('14 days')->toDateString();

        $data = seadmin::where('company_tlc_end','=',$alerttime)
                         ->join('company_user','seadmin.com_id','=','company_user.company_id')
                         ->join('users','company_user.user_id','=','users.id')
                         ->select('seadmin.*','users.email','users.name','company_user.*')->get();
						 
        $forse = seadmin::where('company_tlc_end','=',$alerttime)->get();
		
		//return dd($data);
        if(!$data->isEmpty()){
            activity()->log('提醒到期檢查D30Y');
            return $this->tlcalert($data,$forse);
        }
        \Session::flash('checkno_message', 'No Expire!');
        activity()->log('提醒到期檢查D14N');
        return redirect()->action('ToolController@index');

    }

      public function tlcchecknow(){
        //30天後到期
        $time = Carbon::now()->toDateString();
        //----取得系統時間---加減(現在時間1天前)--轉為日期去掉分秒
        $alerttime = Carbon::now()->addDays(-1)->toDateString();
        //return dd($alerttime);
        //$alerttime = Carbon::now()->modify('14 days')->toDateString();

        $data = seadmin::where('company_tlc_end','=',$alerttime)
                         ->join('company_user','seadmin.com_id','=','company_user.company_id')
                         ->join('users','company_user.user_id','=','users.id')
                         ->select('seadmin.*','users.email','users.name','company_user.*')->get();
		
		$forse = seadmin::where('company_tlc_end','=',$alerttime)->get();
		
        //return dd($data);
        if(!$data->isEmpty()){
            return $this->tlcalert($data,$forse);
        }
        \Session::flash('checkno_message', 'No Expire!');
        activity()->log('提醒到期檢查1D');
        return redirect()->action('ToolController@index');

    }

    public function tlcalert($data,$forse){

    	//return dd($data);

    	$APIswitch = APIswitch::first();

    	switch ($APIswitch->mode) {
    		case 'API':
               
                foreach ($forse as $seadmin) {
                //return dd($seadmin);
                
                //$se_list = json_encode([$cdata->email]);

                 //通知SE用
                $cdata = User::where('user_group','=','4')->get();

                    foreach ($cdata as $user) {
                        $account_list = json_encode([$user->email]);

                         //API內容
                    $content = $seadmin->company_name.'「'.$seadmin->type.'」功能將於：'.$seadmin->company_tlc_end.'到期並關閉此功能，特發此提醒， 請SE協助關閉此客戶TLC功能。此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

                    $msg_push = $seadmin->type.'到期提醒';

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
                    }
                } 

                //通知相關人員
    			foreach ($data as $seadmin) {

           		$account_list = json_encode([$seadmin->email]);

                //API內容
        		$content = $seadmin->company_name.'「'.$seadmin->type.'」功能將於：'.$seadmin->company_tlc_end.'到期並關閉此功能，特發此提醒， 如需申請續開，敬請提早洽談續約事宜。此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

                $msg_push = $seadmin->type.'到期提醒';

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
            	} 
                    activity()->log('提醒到期通知By_API');
    			break;
    		
    		case 'Email':
                
                foreach ($forse as $seadmin) {
                    //通知SE用
                    $cdata = User::where('user_group','=','4')->get();
                    foreach ($cdata as $user) {
                        //mail# code...
                        Mail::to($user->email)->send(new TLCAlert($seadmin));
                    }
                    
                }

    			foreach ($data as $seadmin) {
    				//mail# code...
    				Mail::to($seadmin->email)->send(new TLCAlert($seadmin));
    			}
                    activity()->log('提醒到期通知By_Mail');
    			break;

    		case 'Both':
                foreach ($forse as $seadmin) {
                //return dd($seadmin);
                
                //$se_list = json_encode([$cdata->email]);

                 //通知SE用
                $cdata = User::where('user_group','=','4')->get();

                    foreach ($cdata as $user) {
                        $account_list = json_encode([$user->email]);

                         //API內容
                    $content = $seadmin->company_name.'「'.$seadmin->type.'」功能將於：'.$seadmin->company_tlc_end.'到期並關閉此功能，特發此提醒， 請SE協助關閉此客戶TLC功能。此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

                    $msg_push = $seadmin->type.'到期提醒';

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
                    }
                } 

                //通知相關人員
    			foreach ($data as $seadmin) {
           		//return dd($seadmin);
				$cdata = User::where('user_group','=','4')->get();
				//$se_list = json_encode([$cdata->email]);
				
           		$account_list = json_encode([$seadmin->email]);
                //API內容
        		$content = $seadmin->company_name.'「'.$seadmin->type.'」功能將於：'.$seadmin->company_tlc_end.'到期並關閉此功能，特發此提醒， 如需申請續開，敬請提早洽談續約事宜。此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。';

                $msg_push = $seadmin->type.'到期提醒';

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

        		\View::share('seadmin', $seadmin);
                //$content = [];
                //$time = Carbon::now();  

                //\View::share('time', $time);
                
                
            } 
			
				//寄出信件
                foreach ($forse as $seadmin) {
                    //通知SE用
                    $cdata = User::where('user_group','=','4')->get();
                    foreach ($cdata as $user) {
                        //mail# code...
                        Mail::to($user->email)->send(new TLCAlert($seadmin));
                    }
                    
                }
                //通知相關人員
				foreach ($data as $seadmin) {
    				//mail# code...
    				Mail::to($seadmin->email)->send(new TLCAlert($seadmin));
    			}
                    activity()->log('提醒到期通知BOTH');
    			break;
    	}

            \Session::flash('check_message', 'Check Complete!');
        	return redirect()->action('ToolController@index');

    }



}

