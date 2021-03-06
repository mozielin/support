<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\status;
use App\company;
use App\company_type;
use App\company_industry;
use App\plan;
use App\User;
use App\contract;   
use App\server;
use App\applicant; 
use DB;
use App\license;
use App\seadmin;
use App\temp;
use App\manager;
use App\company_area;
use App\k_value;
use App\version;
use App\Receipt;
use Auth;
use Response;


class ExportController extends Controller
{
   	public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){

			$k = k_value::orderBy('id','DESC')->first();
		
		   return view('export.export_all')
		   			->with('k',$k);
	}

	public function export(){

			global $time;
			$time = Carbon::now()->toDateString(); 
			$data = status::all();

			\Excel::create('版本_'.$time, function($excel)use($data) {

	    	$excel->sheet('Company_sheet', function($sheet)use($data) {

	        $sheet->loadView('export.view_first')

	        		->with('data',$data);

	    	})->export('xls');

	    });

	}

	public function autotal(){

			global $time;
			$time = Carbon::now()->toDateString(); 
			//公司資料
			$company = company::join('plan','company.com_plan_id','=','plan.id')
              ->join('company_types','company.com_type_id','=','company_types.id')
              ->join('company_area','company.company_area','=','company_area.id')
              ->join('company_industry','company.com_industry_id','=','company_industry.id')
              ->join('status','company.company_status','=','status.id')
              ->select('company.*','company_types.company_type_name','company_industry.company_industry_name','plan.plan_name','status.status_name','company_area.area_name')
              ->orderBy('company.id','DESC')
              ->get();

              $applicant = applicant::join('company','company_applicant.company_id','=','company.id')
              							->select('company_applicant.*','company.company_name')
              							->orderBy('company_applicant.id','DESC')->get();

            $manager = manager::join('company','company_user.company_id','=','company.id')
              							->select('company_user.*','company.company_name')->get();
			 
				// or we can also do this $newMediaProjects->toBase()->merge($filmProjects);
				 
				//return dd($company,$applicant);
				                 	
             // return dd($newMediaProjects->toArray());

              $users = User::orderBy('users.id','DESC')->get();
          
              //lic資料
              //$licensenum = license::where('company_id','=',$company_id)->count();
              $license = license::orderBy('license.id','DESC')
              						->join('company','license.company_id','company.id')
              						->join('status','license.status_id','=','status.id')
              						->select('license.*','company.company_name','status.status_name')
              						->get();
              //合約數
              //$contractnum = contract::where('company_contract','=',$company_id)->count();
              //合約資料
              //$contract = contract::orderBy('company_contract.id','desc')->get();
              //合約方案             						
              $contract = contract::join('plan','company_contract.contract_plan','=','plan.id')
              						->join('company','company_contract.company_contract','company.id')
              						->join('status','company_contract.contract_status','=','status.id')
              						->select('company_contract.*','company.company_name','status.status_name','plan.plan_name')
              						->orderBy('company_contract.id','DESC')->get();

              $contractf = contract::join('plan','company_contract.contract_plan','=','plan.id')
              						->join('company','company_contract.company_contract','company.id')
              						->join('status','company_contract.contract_status','=','status.id')
              						->select('company_contract.*','company.company_name','status.status_name','plan.plan_name')
              						->orderBy('company_contract.id','DESC')->first();

               //掃一遍license_function有SYNC挑出來存EXCEL
            //千呼萬喚使出來得SQL
                //      抓LIC表--結合--LIC&FUN關連表------用LIC表的ID-等於----LIC&FUN關連表---的LID-----
                $ldata = license::join('license_function','license.id','=','license_function.license_id')
                                ->join('company','license.company_id','=','company.id')
                                ->join('license_mac','license_mac.license_id','=','license.id')
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
                                
                                ->select('license.company_id','company.company_name','license_function.*','license_mac.mac')
                                ->get();

                                

          
              //server資料		
              //$servernum = server::where('company_server','=',$company_id)->count();
              $server = server::join('company','company_server_info.company_server','company.id')
              						->select('company_server_info.*','company.company_name')
              						->orderBy('company_server_info.id','DESC')->get();
              //相關人員資料
              //$managernum = manager::where('company_id','=',$company_id)->count();
              //$manager = manager::orderBy('user_id','DESC')->get();
              $tlc = seadmin::orderBy('id','DESC')->get();

              $vdata = version::all();

              //發票資料
              $receipt = receipt::join('company','company.id','=','receipt.company_id')
              					->join('company_contract','company_contract.id','=','receipt.contract_id')
              					->select('receipt.*','company.company_name','company_contract.contract_title')
              					->orderBy('receipt.id','DESC')
              					->get();
              //return dd($receipt);
			
			
			\Excel::create('Total_'.$time, function($excel)use($company,$applicant,$users,$contract,$license,$server,$tlc,$manager,$contractf,$vdata,$ldata,$receipt) {

	    	$excel->sheet('Company', function($sheet)use($company,$applicant,$users,$contract,$license,$manager) {
	    		//return dd($contract);
	    		//return dd($company,$applicant,$users,$contract,$license);
	        $sheet->loadView('export.total')
	        		->with('company',$company)
	        		->with('applicant',$applicant)
	        		->with('users',$users)
	        		->with('license',$license)
	        		->with('contract',$contract)
	        		->with('manager',$manager);
	    	});

	    	$excel->sheet('Contract', function($sheet)use($contract,$users) {

	        $sheet->loadView('export.contract')
	        		->with('contract',$contract)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('License', function($sheet)use($license,$users) {

	        $sheet->loadView('export.license')
	        		->with('license',$license)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('Applicant', function($sheet)use($applicant,$users) {

	        $sheet->loadView('export.applicant')
	        		->with('applicant',$applicant)
	        		->with('users',$users); 
	    	});

	    	$excel->sheet('Server', function($sheet)use($server,$users,$vdata) {

	        $sheet->loadView('export.server')
	        		->with('server',$server)
	        		->with('users',$users)
	        		->with('vdata',$vdata);
	    	});

	    	$excel->sheet('TLC', function($sheet)use($tlc,$users) {

	        $sheet->loadView('export.tlc')
	        		->with('tlc',$tlc)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('SyncDaemon', function($sheet)use($ldata,$users,$server,$vdata) {

	        $sheet->loadView('export.SyncDaemon')
	        		->with('ldata',$ldata)
	        		->with('server',$server)
	        		->with('users',$users)
	        		->with('vdata',$vdata);
	    	});

	    	$excel->sheet('Receipt', function($sheet)use($receipt,$users) {

	        $sheet->loadView('export.receipt')
	        		->with('receipt',$receipt)
	        		->with('users',$users);
	    	});


	    	$excel->store('xls',storage_path('/app/public/export'));

	    });
			activity()->log('每日總表備份');

			//寄給客服&管理群組
			//$user = User::where('user_group','=','3')
			//            ->orWhere('user_group','=','1')->get();
      //寄給DORIS
      $user = User::where('id','=','33')->get();
			//寄給按下按鈕的人
			//$login = Auth::user();

            //return dd($login->email,$login->name);
            //foreach ($user as $udata) {

                $from = ['email'=> 'support@teamplus.com.tw',
                'name'=>'Team+ Support',
                'subject'=> '每日總表備份'];
                $to = ['email'=> $user->email,
                'name'=> $user->name];
                //信件的內容(即表單填寫的資料)
                $content = ['Best Regard by_Ryan'];
                //$time = Carbon::now();  

                //\View::share('time', $time);
                //寄出信件
                \Mail::send('email.test',$content, function($message) use ($from, $to) {
                    $message->from($from['email'], $from['name']);
                    $message->to($to['email'], $to['name'])->subject($from['subject']);
                    $time = Carbon::now()->toDateString();
                    $path = storage_path('app/public/export/Total_'.$time.'.xls');
                    $message->attach($path);
                }); 

            //}

            \Storage::delete('/public/export/Total_'.$time.'.xls');

            return redirect()->route('export_all');
	}

	public function total(){

			global $time;
			$time = Carbon::now()->toDateString(); 
			//公司資料
			$company = company::join('plan','company.com_plan_id','=','plan.id')
              ->join('company_types','company.com_type_id','=','company_types.id')
              ->join('company_area','company.company_area','=','company_area.id')
              ->join('company_industry','company.com_industry_id','=','company_industry.id')
              ->join('status','company.company_status','=','status.id')
              ->select('company.*','company_types.company_type_name','company_industry.company_industry_name','plan.plan_name','status.status_name','company_area.area_name')
              ->orderBy('company.id','DESC')
              ->get();

              $applicant = applicant::join('company','company_applicant.company_id','=','company.id')
              							->select('company_applicant.*','company.company_name')
              							->orderBy('company_applicant.id','DESC')->get();

            $manager = manager::join('company','company_user.company_id','=','company.id')
              							->select('company_user.*','company.company_name')->get();
			 
				// or we can also do this $newMediaProjects->toBase()->merge($filmProjects);
				 
				//return dd($company,$applicant);
				                 	
             // return dd($newMediaProjects->toArray());

              $users = User::orderBy('users.id','DESC')->get();
          
              //lic資料
              //$licensenum = license::where('company_id','=',$company_id)->count();
              $license = license::orderBy('license.id','DESC')
              						->join('company','license.company_id','company.id')
              						->join('status','license.status_id','=','status.id')
              						->select('license.*','company.company_name','status.status_name')
              						->get();
              //合約數
              //$contractnum = contract::where('company_contract','=',$company_id)->count();
              //合約資料
              //$contract = contract::orderBy('company_contract.id','desc')->get();
              //合約方案             						
              $contract = contract::join('plan','company_contract.contract_plan','=','plan.id')
              						->join('company','company_contract.company_contract','company.id')
              						->join('status','company_contract.contract_status','=','status.id')
              						->select('company_contract.*','company.company_name','status.status_name','plan.plan_name')
              						->orderBy('company_contract.id','DESC')->get();

              $contractf = contract::join('plan','company_contract.contract_plan','=','plan.id')
              						->join('company','company_contract.company_contract','company.id')
              						->join('status','company_contract.contract_status','=','status.id')
              						->select('company_contract.*','company.company_name','status.status_name','plan.plan_name')
              						->orderBy('company_contract.id','DESC')->first();

               //掃一遍license_function有SYNC挑出來存EXCEL
            //千呼萬喚使出來得SQL
                //      抓LIC表--結合--LIC&FUN關連表------用LIC表的ID-等於----LIC&FUN關連表---的LID-----
                $ldata = license::join('license_function','license.id','=','license_function.license_id')
                                ->join('company','license.company_id','=','company.id')
                                ->join('license_mac','license_mac.license_id','=','license.id')
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
                                
                                ->select('license.company_id','company.company_name','license_function.*','license_mac.mac')
                                ->get();

                                

          
              //server資料		
              //$servernum = server::where('company_server','=',$company_id)->count();
              $server = server::join('company','company_server_info.company_server','company.id')
              						->select('company_server_info.*','company.company_name')
              						->orderBy('company_server_info.id','DESC')->get();
              //相關人員資料
              //$managernum = manager::where('company_id','=',$company_id)->count();
              //$manager = manager::orderBy('user_id','DESC')->get();
              $tlc = seadmin::orderBy('id','DESC')->get();

              $vdata = version::all();

              //發票資料
              $receipt = receipt::join('company','company.id','=','receipt.company_id')
              					->join('company_contract','company_contract.id','=','receipt.contract_id')
              					->select('receipt.*','company.company_name','company_contract.contract_title')
              					->orderBy('receipt.id','DESC')
              					->get();
              //return dd($receipt);
			
			
			\Excel::create('Total_'.$time, function($excel)use($company,$applicant,$users,$contract,$license,$server,$tlc,$manager,$contractf,$vdata,$ldata,$receipt) {

	    	$excel->sheet('Company', function($sheet)use($company,$applicant,$users,$contract,$license,$manager) {
	    		//return dd($contract);
	    		//return dd($company,$applicant,$users,$contract,$license);
	        $sheet->loadView('export.total')
	        		->with('company',$company)
	        		->with('applicant',$applicant)
	        		->with('users',$users)
	        		->with('license',$license)
	        		->with('contract',$contract)
	        		->with('manager',$manager);
	    	});

	    	$excel->sheet('Contract', function($sheet)use($contract,$users) {

	        $sheet->loadView('export.contract')
	        		->with('contract',$contract)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('License', function($sheet)use($license,$users) {

	        $sheet->loadView('export.license')
	        		->with('license',$license)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('Applicant', function($sheet)use($applicant,$users) {

	        $sheet->loadView('export.applicant')
	        		->with('applicant',$applicant)
	        		->with('users',$users); 
	    	});

	    	$excel->sheet('Server', function($sheet)use($server,$users,$vdata) {

	        $sheet->loadView('export.server')
	        		->with('server',$server)
	        		->with('users',$users)
	        		->with('vdata',$vdata);
	    	});

	    	$excel->sheet('TLC', function($sheet)use($tlc,$users) {

	        $sheet->loadView('export.tlc')
	        		->with('tlc',$tlc)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('SyncDaemon', function($sheet)use($ldata,$users,$server,$vdata) {

	        $sheet->loadView('export.SyncDaemon')
	        		->with('ldata',$ldata)
	        		->with('server',$server)
	        		->with('users',$users)
	        		->with('vdata',$vdata);
	    	});

	    	$excel->sheet('Receipt', function($sheet)use($receipt,$users) {

	        $sheet->loadView('export.receipt')
	        		->with('receipt',$receipt)
	        		->with('users',$users);
	    	});


	    	$excel->store('xls',storage_path('/app/public/export'));

	    });


      $path = storage_path('app/public/export/Total_'.$time.'.xls');

			activity()->log('總表匯出');
      //直接下載
      return Response::download($path);
      /*
			//寄給客服&管理群組
			$user = User::where('user_group','=','3')
			            ->orWhere('user_group','=','1')->get();
			//寄給按下按鈕的人
			$login = Auth::user();

            //return dd($login->email,$login->name);
            //foreach ($login as $udata) {

                $from = ['email'=> 'support@teamplus.com.tw',
                'name'=>'Team+ Support',
                'subject'=> '客服系統總表匯出'];
                $to = ['email'=> $login->email,
                'name'=> $login->name];
                //信件的內容(即表單填寫的資料)
                $content = ['FYI'];
                //$time = Carbon::now();  

                //\View::share('time', $time);
                //寄出信件
                \Mail::send('email.test',$content, function($message) use ($from, $to) {
                    $message->from($from['email'], $from['name']);
                    $message->to($to['email'], $to['name'])->subject($from['subject']);
                    $time = Carbon::now()->toDateString();
                    $path = storage_path('app/public/export/Total_'.$time.'.xls');
                    $message->attach($path);
                }); 

            //}

            \Storage::delete('/public/export/Total_'.$time.'.xls');

            return redirect()->route('export_all');*/
	}

	public function download_total(){

			global $time;
			$time = Carbon::now()->toDateString(); 
			$data = status::all();

			\Excel::create('發版_'.$time, function($excel)use($data) {

	    	$excel->sheet('Company_sheet', function($sheet)use($data) {

	        $sheet->loadView('export.view_first')

	        		->with('data',$data);

	    	})->export('xls');

	    	});

	}

	public function upload_cloud(Request $request){

		activity()->log('產出發版');

		if ($request->hasFile('excel')){
	        //取得附件檔名
	        $filename = $request->excel->getClientOriginalName();           
	        //附件檔名儲存      
	        $store = $request->file('excel')->store('public/excel');
	        $path = $request->file('excel')->getRealPath();
	        $del = temp::truncate();

			
	        \Excel::load($path, function($reader) {
								
				foreach ($reader->toArray() as $row) {
					//return dd($row);
					if ($row['公司名稱']) {
						$data = new temp;
						$data -> company_name = $row['公司名稱'];
						$data -> teampluscode = $row['企業代碼'];
						$data -> server_name = $row['ServerName'];
						$data -> url = $row['ServerUrl'];
						$data -> licensekey = $row['License Key'];
						$data -> save();
					}
					else{
						break;
					}
	            }
			});

			$temp = temp::join('company_server_info','company_server_info.company_business_code','=','temp.teampluscode')
						->join('company','company_server_info.company_server','=','company.id')
						->select('company_server_info.*','company.company_name','temp.licensekey','company.com_sales_id')
						->groupBy('company_server_info.company_business_code')
						->get();
			//

			$server = server::join('company','company_server_info.company_server','company.id')
              						->select('company_server_info.company_business_code','company.*')
              						->groupBy('company_server_info.company_business_code')
              						->orderBy('company.id','DESC')->get();

            $manager = manager::join('company','company_user.company_id','=','company.id')
            				  ->join('users','company_user.user_id','=','users.id')
            				  ->where('users.user_group','=','3')
              				  ->select('company_user.*','company.company_name','users.email')->get(); 

            $applicant = applicant::join('company','company_applicant.company_id','=','company.id')
              							->select('company_applicant.*')
              							->orderBy('company_applicant.id','DESC')->get();

            $k = k_value::orderBy('id','DESC')->first();
			//return dd($server);
            $time = Carbon::now()->toDateString(); 

            $users = User::orderBy('users.id','DESC')->get();

			\Excel::create('發版_'.$time, function($excel)use($temp,$server,$manager,$users,$applicant,$k) {

	    	$excel->sheet('Company_sheet', function($sheet)use($temp,$server,$manager,$users,$applicant,$k) {

	        $sheet->loadView('export.special')

	        	  ->with('temp',$temp)
	        	  ->with('server',$server)
	        	  ->with('manager',$manager)
	        	  ->with('applicant',$applicant)
	        	  ->with('users',$users)
	        	  ->with('k',$k);

	    	})->export('xls');

	    	});


			
		}
		return view('export.export_all');
	}

	public function export_k(Request $request){


			$data = new k_value;
			$data -> value = $request->k;
			$data -> save();
	    \Session::flash('flash_message', '新增成功! 請上傳私有雲名單產出發版參數~');
		return redirect()->action('ExportController@index');
	}




}
