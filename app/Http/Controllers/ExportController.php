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

          
              //server資料		
              //$servernum = server::where('company_server','=',$company_id)->count();
              $server = server::join('company','company_server_info.company_server','company.id')
              						->select('company_server_info.*','company.company_name')
              						->orderBy('company_server_info.id','DESC')->get();
              //相關人員資料
              //$managernum = manager::where('company_id','=',$company_id)->count();
              //$manager = manager::orderBy('user_id','DESC')->get();
              $tlc = seadmin::orderBy('id','DESC')->get();

			

			\Excel::create('總表_'.$time, function($excel)use($company,$applicant,$users,$contract,$license,$server,$tlc,$manager) {

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

	    	$excel->sheet('Server', function($sheet)use($server,$users) {

	        $sheet->loadView('export.server')
	        		->with('server',$server)
	        		->with('users',$users);
	    	});

	    	$excel->sheet('TLC', function($sheet)use($tlc,$users) {

	        $sheet->loadView('export.tlc')
	        		->with('tlc',$tlc)
	        		->with('users',$users);
	    	});


	    	$excel->export('xls');

	    });

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

		if ($request->hasFile('excel')){
	        //取得附件檔名
	        $filename = $request->excel->getClientOriginalName();           
	        //附件檔名儲存      
	        $store = $request->file('excel')->store('public/excel');
	        $path = $request->file('excel')->getRealPath();
	        $del = temp::truncate();

			
	        \Excel::load($path, function($reader) {
								
				foreach ($reader->toArray() as $row) {
					return dd($row);
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
						->select('company_server_info.*','company.company_name','temp.licensekey')
						->get();
			//

			$server = server::join('company','company_server_info.company_server','company.id')
              						->select('company_server_info.company_business_code','company.*')
              						->orderBy('company.id','DESC')->get();

            $manager = manager::join('company','company_user.company_id','=','company.id')
            				  ->join('users','company_user.user_id','=','users.id')
            				  ->where('users.user_group','=','3')
              				  ->select('company_user.*','company.company_name','users.email')->get(); 

            $applicant = applicant::join('company','company_applicant.company_id','=','company.id')
              							->select('company_applicant.*')
              							->orderBy('company_applicant.id','DESC')->get();
			//return dd($manager);
            $time = Carbon::now()->toDateString(); 

            $users = User::orderBy('users.id','DESC')->get();

			\Excel::create('發版_'.$time, function($excel)use($temp,$server,$manager,$users,$applicant) {

	    	$excel->sheet('Company_sheet', function($sheet)use($temp,$server,$manager,$users,$applicant) {

	        $sheet->loadView('export.special')

	        	  ->with('temp',$temp)
	        	  ->with('server',$server)
	        	  ->with('manager',$manager)
	        	  ->with('applicant',$applicant)
	        	  ->with('users',$users);

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
