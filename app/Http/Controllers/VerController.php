<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\patch;
use Excel;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

use Response;
use App\Customer;
use Input;
use App\server;
use App\User;
use App\contract;
use App\license;

class VerController extends Controller{


	public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	//autocomplete
	public function kindex(){

		$num  = 0;
		return view('contract.contract_create',['num' => $num]);
	}

	public function autocomplete(Request $request){
			
		$term=$request->term;//jquery
		$data=patch::where('company_name','LIKE','%'.$term.'%')
		->take(10)
		->get();
		$results=array();
		foreach($data as $v){
			$results[] = ['id' => $v->id,'value'=>$v->company_name];
			//return dd($results);
		}
		return response()->json($results);
	}

	public function autocomplete1(Request $request){
	
		$term=$request->term;//jquery
		$data=patch::where('company_name','LIKE','%'.$term.'%')
		->take(10)
		->get();
		$results=array();
		foreach($data as $v){
			$results[] = ['id' => $v->id,'value'=>$v->company_name];
			//return dd($results);
		}
		return response()->json($results);
	}


	//live search
	public function sindex()
	{
		return view('contract_all.balde');
	}

	public function dynamicsearch(Request $request){
		if($request->ajax())
		{
			$output="";

			//$customers=patch::all()->paginate(10);

			$customers = patch::where('company_name','LIKE','%'.$request->dynamicsearch.'%')->get();
							//return dd($customers);				 
			if($customers)
			{
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class="panel panel-default test" style="cursor:pointer; width:100%;">'.
						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->EIN.
								'</div>'.
							
							'<div class="col-md-4" style="border-right:1px solid black;">'.	
								$customer->company_name.
								'</div>'.	

							'<div class="col-md-4">'.	
									$customer->url.
								'</div>'.	

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
									$customer->ver.
							'</div>'.
									
							'</div>'.              				
						'</div>'.		
					'</div>';
				

						
				}
					return Response($output);
					
			}else
			{
				
					$output.=
					'<div class="panel panel-default test" style="cursor:pointer; width:100%;">'.
						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 'No'.
								'</div>'.
							
							'<div class="col-md-3" style="border-right:1px solid black;">'.	
								'No'.
								'</div>'.	

							'<div class="col-md-5">'.	
									'No'.
								'</div>'.	

							'<div class="col-md-1" style="border-right:1px solid black; border-left:1px solid black;">'.	
									'No'.
							'</div>'.
									
							'</div>'.              				
						'</div>'.		
					'</div>';



						return Response($output);
				//return dd("NO");
				//return Response()->json(['no'=>'Not found']);
			}	
		}
	}

	public function index(){
			//資料搜尋&分頁
		   //$data = patch::orderBy('id','desc')
		   //->paginate(50);

			//傳給視圖
		   return view('patch_all');

	}

	public function loadindex(Request $request){

		if($request->ajax())
		{
			$output="";

			$customers=patch::orderBy('id','desc')
		   		->get();
		   		//return dd($customers);
			//$customers=patch::where('company_name','LIKE','%'.$request->dynamicsearch.'%')->paginate(10);
											 
			if($customers)
			{
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class="panel panel-default test" style="cursor:pointer; width:100%;">'.
						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->EIN.
								'</div>'.
							
							'<div class="col-md-4" style="border-right:1px solid black;">'.	
								$customer->company_name.
								'</div>'.	

							'<div class="col-md-4">'.	
									$customer->url.
								'</div>'.	

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
									$customer->ver.
							'</div>'.
									
							'</div>'.              				
						'</div>'.		
					'</div>';
				

						
				}	//return Response::view('patch_all')->header('Content-Type',$output);
					return Response($output);
					//return view('patch_all',['customers' => $customers]);
					
			}else
			{
				return Response()->json(['no'=>'Not found']);
			}	
		}

	}		



	public function search(Request $request){
		$search = $request->search_name;
		//return dd($search);
		$data = patch::where('company_name','like','%'.$search.'%')
			->orderBy('id','desc')
		    ->paginate(10);
		
		return view('patch_all',['data' => $data]);
	}


	public function export(){

		global $time;
		$data = patch::all();
		$time = Carbon::now()->toDateString(); 
				//$path = '/export'.'Ver_'.$time;
		Excel::create('Ver_'.$time, function($excel) use($data) {
		    $excel->sheet('Version', function($sheet) use($data) {
		    $sheet->fromArray($data);
			//return dd($path)->store('xls',storage_path('/app/public/export'))
		    })->export('xls');	//return dd($path);
			//;	
		});
	}

	public function catch(){

		$company = patch::all();
        //return dd($company);
	        foreach ($company as $company ) {
	        	//return dd($company);
	        	//取出url
				$aurl = $company->url;				
				//return dd($aurl);
				//如果沒有網址就儲存no url
				if($aurl == null){
					$update = patch::find($company->id);
					//return dd($company);
					$version = 'no url';
					$update->ver = $version;
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
								$update = patch::find($company->id);
								//return dd($update);
								$update->ver = $version;
								//return dd($update->ver);
								$update->save();
								//return dd($update->ver);	
							}
							else{//比對是否為數字不是就faild
								//return dd($version);
								$update = patch::find($company->id);
								//return dd($update);
								$update->ver = 'faild';
								//return dd($update->ver);
								$update->save();
								//return dd($update->ver);
							}
					}
  
					else{//如果抓不到ver.txt再嘗試三次
						$cnt=0;  
						while ($cnt < 3 && ($data=@file_get_contents($burl, false, $context)===FALSE)) {
							$cnt++ ;
							}//還是抓不到就faild
							$update = patch::find($company->id);
							//return dd($update);
							$update->ver = 'faild';
							//return dd($update->ver);
							$update->save();
							//return dd($update->ver);
						}
        		}
        
        	}	//回去哪
        return dd('Done');
	}

	public function dailycatch(){

        $company = patch::all();
        //return dd($company);
            foreach ($company as $company ) {
                //return dd($company);
                //取出url
                $update = patch::find($company->id);
                $aurl = $company->url;              
                //return dd($aurl);
                //如果沒有網址就儲存no url
                if($aurl == null){
                    
                    //return dd($company);
                    $version = 'no url';
                    $update->ver = $version;
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
                                'timeout'=>2, 
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
                                //$update = patch::find($company->id);
                                //return dd($update);
                                $update->ver = $version;
                                //return dd($update->ver);
                                $update->save();
                                //return dd($update->ver);  
                            }
                            else{//比對是否為數字不是就faild
                                //return dd($version);
                                //$update = patch::find($company->id);
                                //return dd($update);
                                $update->ver = 'faild';
                                //return dd($update->ver);
                                $update->save();
                                //return dd($update->ver);
                            }
                    }
  
                    else{//如果抓不到ver.txt再嘗試1次
                            $cnt=0;  
                        while ($cnt < 1 && ($data=@file_get_contents($burl, false, $context)===FALSE)) {
                            $cnt++ ;
                            }//還是抓不到就faild
                            //$update = patch::find($company->id);
                            //return dd($update);
                            $update->ver = 'faild';
                            //return dd($update->ver);
                            $update->save();
                            //return dd($update->ver);
                    }
                }
        
            }   //輸出
            $data = patch::all();
            $time = Carbon::now()->toDateString(); 

            	Excel::create('Ver_'.$time, function($excel) use($data){

            		$excel->sheet('Version', function($sheet) use($data) {

            			$sheet->fromArray($data);

            		})->store('xls',storage_path('/app/public/export'));

            //return dd($path);
			//->store('xls',storage_path('/export'));
				$from = ['email'=>'mozielin@gmail.com',
                'name'=>'Team+ Support',
                'subject'=> '每日版本號撈取結果'];
               
            //mail
                $to = ['email'=>'ryan@teamplus.com.tw',
                'name'=>'Ryan'];
                //信件的內容(即表單填寫的資料)
                $content = ['FYI'
                   
                ];
                //$time = Carbon::now();  

                //\View::share('time', $time);
                //寄出信件
                \Mail::send('email.test',$content, function($message) use ($from, $to){
                	$message->from($from['email'], $from['name']);
                	$message->to($to['email'], $to['name'])->subject($from['subject']);
                	$time = Carbon::now()->toDateString();
                	$path = storage_path('/app/public/export/Ver_'.$time.'.xls');
                	$message->attach($path);
                });	
        	}); 
    }
	
    

}
