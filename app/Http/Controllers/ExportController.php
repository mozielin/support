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
use App\manager;
use App\company_area;

class ExportController extends Controller
{
   	public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){
		  
		
		   return view('export.export_all');
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
              ->join('users','company.com_builder_id','=','users.id')
              ->join('status','company.company_status','=','status.id')
              ->select('company.*','company_types.company_type_name','company_industry.company_industry_name','users.name','plan.plan_name','status.status_name','company_area.area_name')
              ->get();

              $applicant = applicant::orderBy('company_applicant.id','DESC')->get();

              
				
				 
				// or we can also do this $newMediaProjects->toBase()->merge($filmProjects);
				 
				//return dd($company,$applicant);
				                 	
             // return dd($newMediaProjects->toArray());
              /*負責業務資料
              $sales = company::join('users','company.com_sales_id','=','users.id')
              					->select('users.name','users.id')
              					->find($company_id);
              //聯絡人資料
              $applicantnum = applicant::where('company_id','=',$company_id)->count();
              $applicant = applicant::where('company_id','=',$company_id)
              						  ->orderBy('company_applicant.id','DESC')->get();
              //lic資料
              $licensenum = license::where('company_id','=',$company_id)->count();
              $license = license::join('status','license.status_id','=','status.id')
                          ->select('license.*','status.status_name')
              					  ->where('company_id','=',$company_id)
              					  ->orderBy('license.id','DESC')->get();
              //合約數
              $contractnum = contract::where('company_contract','=',$company_id)->count();
              //合約資料
              $contract = contract::where('company_contract','=',$company_id)
              					->join('plan','company_contract.contract_plan','=','plan.id')
                                ->join('status','company_contract.contract_status','=','status.id')
                                ->select('company_contract.*','plan.plan_name','status.status_name')
                                ->orderBy('company_contract.id','desc')->get();
              //合約方案             						
              $contract_plan = contract::where('company_contract','=',$company_id)
              						->join('plan','company_contract.contract_plan','=','plan.id')
              						->orderBy('company_contract.contract_plan','DESC')->first();
              //server資料		
              $servernum = server::where('company_server','=',$company_id)->count();
              $server = server::where('company_server','=',$company_id)
              					->orderBy('company_server_info.id','DESC')->get();
              //相關人員資料
              $managernum = manager::where('company_id','=',$company_id)->count();
              $manager = manager::where('company_id','=',$company_id)
                          ->join('users','company_user.user_id','=','users.id')
                          ->join('user_group','users.user_group','=','user_group.id')
                          ->orderBy('user_id','DESC')->get();
			*/

           

			\Excel::create('總表_'.$time, function($excel)use($company,$applicant) {

	    	$excel->sheet('Company_sheet', function($sheet)use($company,$applicant) {

	        $sheet->loadView('export.total')

	        		->with('company',$company)
	        		->with('applicant',$applicant);

	    	})->export('xls');

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

}
