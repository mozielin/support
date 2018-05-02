<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\company;
use App\company_type;
use App\company_industry;
use App\plan;
use App\User;
use App\contract;   
use App\server;
use App\applicant; 
use App\status;
use App\license;
use App\manager;
use App\company_area;
use Entrust;
   
class CompanyController extends Controller
{
    
	public function __construct(){
		    //Auth認證
    		$this->middleware('auth');		
		}

	public function export(){

		$company = company::join('plan','company.com_plan_id','=','plan.id')
              ->join('company_types','company.com_type_id','=','company_types.id')
              ->join('company_industry','company.com_industry_id','=','company_industry.id')
              ->join('users','company.com_builder_id','=','users.id')
              ->join('company_contract','company_contract.company_contract','=','company.id')
              ->select('company.*','company_types.company_type_name','company_industry.company_industry_name','users.name','plan.plan_name','company_contract.*')
              ->get();

		\Excel::create('test', function($excel) use($company) {

            $excel->sheet('Version', function($sheet) use($company) {

            $sheet->fromArray($company);

            })->store('xls',storage_path('/app/public/export'));
        });
	}

	

	public function index(){
	
		return view('company.company_all');
		}	

  public function companytrash(){
    
    return view('company.company_trash');
    } 

	public function view($company_id){

		//驗證查詢userID是否為登入ID||是否有權限查看
		$auth = Auth::user()->id;

		$manager = manager::where('user_id','=',$auth)
						  ->where('company_id','=',$company_id)->first();

		//return dd($manager->user_id);

		if($manager != null || Entrust::hasRole('admin') || Entrust::hasRole('devenlope')){

      $company = company::join('plan','company.com_plan_id','=','plan.id')
              ->join('company_types','company.com_type_id','=','company_types.id')
              ->join('company_area','company.company_area','=','company_area.id')
              ->join('company_industry','company.com_industry_id','=','company_industry.id')
              ->join('users','company.com_builder_id','=','users.id')
              ->join('status','company.company_status','=','status.id')
              ->select('company.*','company_types.company_type_name','company_industry.company_industry_name','users.name','plan.plan_name','status.status_name','company_area.area_name')
              ->find($company_id);

              $sales = company::join('users','company.com_sales_id','=','users.id')
                        ->select('users.name','users.id')
                        ->find($company_id);

              $applicantnum = applicant::where('company_id','=',$company_id)->count();
              $applicant = applicant::where('company_id','=',$company_id)
                            ->orderBy('company_applicant.id','DESC')->get();

              $licensenum = license::where('company_id','=',$company_id)->count();
              $license = license::join('status','license.status_id','=','status.id')
                          ->select('license.*','status.status_name')
                          ->where('company_id','=',$company_id)
                          ->orderBy('license.id','DESC')->get();


              $contractnum = contract::where('company_contract','=',$company_id)->count();

              $contract = contract::where('company_contract','=',$company_id)
                        ->join('plan','company_contract.contract_plan','=','plan.id')
                                ->join('status','company_contract.contract_status','=','status.id')
                                ->select('company_contract.*','plan.plan_name','status.status_name')
                                ->orderBy('company_contract.id','desc')->get();
                                            
              $contract_plan = contract::where('company_contract','=',$company_id)
                          ->join('plan','company_contract.contract_plan','=','plan.id')
                          ->orderBy('company_contract.contract_plan','DESC')->first();
                  if($contract_plan==null){
                    $contractplan = '尚未建立合約';
                    
                  }
                  else{
                    $contractplan = $contract_plan->plan_name;
                  }



              //return dd($contractplan);

              $servernum = server::where('company_server','=',$company_id)->count();
              $server = server::where('company_server','=',$company_id)
                        ->orderBy('company_server_info.id','DESC')->get();


              $managernum = manager::where('company_id','=',$company_id)->count();
              $manager = manager::where('company_id','=',$company_id)
                          ->join('users','company_user.user_id','=','users.id')
                          ->join('user_group','users.user_group','=','user_group.id')
                          ->orderBy('user_id','DESC')->get();

           //return dd($company); 
           return view('company.company_view')
                  ->with('data',$company)
                  ->with('applicantnum',$applicantnum)
                  ->with('applicant',$applicant)
                  ->with('contract',$contract)
                  ->with('contractplan',$contractplan)
                  ->with('contractnum',$contractnum)
                  ->with('servernum',$servernum)
                  ->with('server',$server)
                  ->with('sales',$sales)
                  ->with('license',$license)
                  ->with('licensenum',$licensenum)
                      ->with('manager',$manager)
                      ->with('managernum',$managernum);
			
		}
    else{
    			\Session::flash('flash_message', '權限不足!');
              return view('denied');

        }
        
    }

    public function viewtrash($company_id){
      $company = company::join('plan','company.com_plan_id','=','plan.id')
              ->join('company_types','company.com_type_id','=','company_types.id')
              ->join('company_area','company.company_area','=','company_area.id')
              ->join('company_industry','company.com_industry_id','=','company_industry.id')
              ->join('users','company.com_builder_id','=','users.id')
              ->join('status','company.company_status','=','status.id')
              ->select('company.*','company_types.company_type_name','company_industry.company_industry_name','users.name','plan.plan_name','status.status_name','company_area.area_name')
              ->withTrashed()
              ->find($company_id);

              $sales = company::join('users','company.com_sales_id','=','users.id')
                        ->select('users.name','users.id')
                        ->withTrashed()
                        ->find($company_id);

              $deleter = company::join('users','company.deleter','=','users.id')
                          ->select('users.name')
                          ->withTrashed()
                          ->find($company_id);

              $applicantnum = applicant::where('company_id','=',$company_id)->withTrashed()->count();

              $applicant = applicant::where('company_id','=',$company_id)
                            ->withTrashed()
                            ->orderBy('company_applicant.id','DESC')->get();

              $licensenum = license::where('company_id','=',$company_id)->withTrashed()->count();
              $license = license::join('status','license.status_id','=','status.id')
                          ->select('license.*','status.status_name')
                          ->where('company_id','=',$company_id)
                          ->withTrashed()
                          ->orderBy('license.id','DESC')->get();

              $contractnum = contract::where('company_contract','=',$company_id)->withTrashed()->count();

              $contract = contract::where('company_contract','=',$company_id)
                        ->join('plan','company_contract.contract_plan','=','plan.id')
                                ->join('status','company_contract.contract_status','=','status.id')
                                ->select('company_contract.*','plan.plan_name','status.status_name')
                                ->withTrashed()
                                ->orderBy('company_contract.id','desc')->get();
                                            
              $contract_plan = contract::where('company_contract','=',$company_id)
                          ->join('plan','company_contract.contract_plan','=','plan.id')
                          ->withTrashed()
                          ->orderBy('company_contract.contract_plan','DESC')->first();
                  if($contract_plan==null){
                    $contractplan = '尚未建立合約';
                    
                  }
                  else{
                    $contractplan = $contract_plan->plan_name;
                  }


              //return dd($contractplan);

              $servernum = server::where('company_server','=',$company_id)->withTrashed()->count();
              $server = server::where('company_server','=',$company_id)
                        ->withTrashed()
                        ->orderBy('company_server_info.id','DESC')->get();
//return dd($server);
              $managernum = manager::where('company_id','=',$company_id)->withTrashed()->count();
              $manager = manager::where('company_id','=',$company_id)
                          ->join('users','company_user.user_id','=','users.id')
                          ->join('user_group','users.user_group','=','user_group.id')
                          ->withTrashed()
                          ->orderBy('user_id','DESC')->get();


           //return dd($company); 
           return view('company.company_viewtrash')
                  ->with('data',$company)
                  ->with('applicantnum',$applicantnum)
                  ->with('applicant',$applicant)
                  ->with('contract',$contract)
                  ->with('contractplan',$contractplan)
                  ->with('contractnum',$contractnum)
                  ->with('servernum',$servernum)
                  ->with('server',$server)
                  ->with('sales',$sales)
                  ->with('license',$license)
                  ->with('licensenum',$licensenum)
                  ->with('manager',$manager)
                  ->with('managernum',$managernum)
                  ->with('deleter',$deleter);
      }

    public function create(){
    	   $typedata = company_type::all();
    	   $industrydata = company_industry::all();
    	   $plandata = plan::all();
    	   $userdata = User::all();
         $area = company_area::all();
         $class = "案件";
    	   $status = status::where('status_class','=',$class)->get();

		   return view('company.company_create')
		   				->with('typedata',$typedata)
		   				->with('plandata',$plandata)
		   				->with('industrydata',$industrydata)
		   				->with('userdata',$userdata)
		   				->with('status',$status)
              ->with('area',$area);
		}

	public function store(Request $request){
			//驗證欄位
			$validator = Validator::make($request->all(),[
				'company_name' => 'required|unique:company|max:40',				
        'company_status' => 'required',
        'company_plan' => 'required',
        'company_sales' => 'required'
				]);
			//驗證失敗回傳資料及錯誤訊息
			if ($validator->fails()){
				return redirect('company/create')
						->withErrors($validator)
						->withInput();
			}
			//資料儲存
			$data = new company;
			$data -> company_name = $request->company_name;
			$data -> company_cel = $request->company_cel;
			$data -> company_url = $request->company_url;
			$data -> company_population = $request->company_population;
			$data -> company_capital = $request->company_capital;
			$data -> company_EIN = $request->company_EIN;
			$data -> com_type_id = $request->company_type;
			$data -> com_industry_id = $request->company_industry;
			$data -> com_plan_id = $request->company_plan;
      $data -> company_area = $request->company_area;
			$data -> com_sales_id = $request->company_sales;
			$data -> com_builder_id = $request->company_builder;
			$data -> company_create = $request->company_create;
			$data -> company_engname = $request->company_engname;
			$data -> company_status = $request->company_status;
      if ($request->has('note')) {
        $data -> note = $request->note;
      } 

      if ($request->has('company_area2')) {
        $data -> company_area2 = $request->company_area2;
      }
			$data -> save();

      //新增預設相關人員(Doris/Betty/Kiki)
      
      $data->manager()->attach('3');
      $data->manager()->attach('6');
      $data->manager()->attach('7');

      $data->manager()->detach($data->com_sales_id);
      $data->manager()->attach($data->com_sales_id);

      \Session::flash('flash_message', '新增成功!');
			return redirect()->action('CompanyController@index');
		}

	public function edit($company_id){
			$data = company::join('users','company.com_builder_id','=','users.id')
							->select('company.*','users.name')
							->find($company_id);
			$typedata = company_type::all();
    	   	$industrydata = company_industry::all();
    	   	$plandata = plan::all();
    	   	$user = User::all();
          $area = company_area::all();
          $class = "案件";
          $status = status::where('status_class','=',$class)->get();
    	   	
			return view('company.company_edit')
						->with('data',$data)
						->with('typedata',$typedata)
						->with('plandata',$plandata)
						->with('industrydata',$industrydata)
						->with('user',$user)
						->with('status',$status)
            ->with('area',$area);
				
		}

	public function update(Request $request,$id){
      //驗證欄位
      $validator = Validator::make($request->all(),[
        'company_name' => 'required|max:40',        
        'company_status' => 'required',
        'company_plan' => 'required',
        'company_sales' => 'required'
        ]);
      //驗證失敗回傳資料及錯誤訊息
      if ($validator->fails()){
        return redirect('company/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
      }

			$data = company::find($id);
      $data->manager()->detach($data->com_sales_id);
      $data -> company_name = $request->company_name;
			$data -> company_cel = $request->company_cel;
			$data -> company_url = $request->company_url;
			$data -> company_population = $request->company_population;
			$data -> company_capital = $request->company_capital;
			$data -> company_EIN = $request->company_EIN;
			$data -> com_type_id = $request->company_type;
      $data -> company_area = $request->company_area;
			$data -> com_industry_id = $request->company_industry;
			$data -> com_plan_id = $request->company_plan;
			$data -> com_sales_id = $request->company_sales;
			$data -> company_create = $request->company_create;
			$data -> company_engname = $request->company_engname;
			$data -> company_status = $request->company_status;
      if ($request->has('note')) {
        $data -> note = $request->note;
      } 
      if ($request->has('company_area2')) {
        $data -> company_area2 = $request->company_area2;
      }

      $data -> save();

      
      $data->manager()->attach($data->com_sales_id);

          \Session::flash('flash_message', '更新成功!');
        	return redirect()->action('CompanyController@view',$id);
		}

	public function delete($id){
      //return dd(Auth::id());
      $data = company::find($id);
      $data -> deleter = Auth::id();
      $data ->save();

      $contract = contract::where('company_contract','=',$id)->get();
      if ($contract != null) {
        foreach ($contract as $deldata ) {
         $deldata -> deleter = Auth::id();
         $deldata ->save();
         $deldata ->delete();
       }
      } 

      $applicant = applicant::where('company_id','=',$id)->get(); 
      if ($applicant != null) {
        foreach ($applicant as $deldata ) {
         //return dd($applicant);
         $deldata -> deleter = Auth::id();
         $deldata ->save();
         $deldata ->delete();
       }
      }

      $license = license::where('company_id','=',$id)->get(); 
      if ($license != null) {
        foreach ($license as $deldata ) {
         $deldata -> deleter = Auth::id();
         $deldata ->save();
         $deldata ->delete();
       }
      }

      $server = server::where('company_server','=',$id)->get(); 
      if ($server != null) {
        foreach ($server as $deldata ) {
         $deldata -> deleter = Auth::id();
         $deldata ->save();
         $deldata ->delete();
       }
      }

      $data -> delete();
 
      //company::delete($id);
      return redirect()->action('CompanyController@index');
    }

    public function restore($id){

      $data = company::onlyTrashed()->find($id);

      $applicant = applicant::onlyTrashed()->where('company_id','=',$id)->restore();
     
      $contract = contract::onlyTrashed()->where('company_contract','=',$id)->restore();
     
      $license = license::onlyTrashed()->where('company_id','=',$id)->restore();
    
      $server = server::onlyTrashed()->where('company_server','=',$id)->restore();

      $data ->restore();

      return redirect()->action('CompanyController@index');
    }

    public function loadcom(Request $request){

    	if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);
            $auth = Auth::id();
            
            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope')){
                
               $customers = company::join('plan', 'company.com_plan_id','=', 'plan.id')
                ->join('users','company.com_sales_id','=','users.id')
                ->join('status','company.company_status','=','status.id')
                ->select('company.*','plan.plan_name','users.name','status.status_name')
                ->orderBy('company.id','desc')
                ->get();
            }
            else{
                $customers = manager::where('company_user.user_id','=',$auth)
                    ->join('company','company_user.company_id','=','company.id')
                    ->join('plan', 'company.com_plan_id','=', 'plan.id')
                    ->join('users','company.com_sales_id','=','users.id')
                    ->join('status','company.company_status','=','status.id')
                   // ->join('comapny_user','company_user.company_id','=','comapny.id')
                   // ->where('comapny_user','comapny_user.user_id','=',$auth)
                    ->select('company.*','plan.plan_name','users.name','status.status_name')
                    ->orderBy('company.id','desc')
                    ->get();

            }


                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../company/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->company_create.
                                '</div>'.
                            
                            '<div class="col-md-4" style="border-right:1px solid black;">'. 
                                $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->plan_name.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->status_name.
                            '</div>'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->name.
                            '</div>'.
                                    
                            '</div>'.                           
                        '</div>'.       
                    '</div>';
                                     
                }
                    return Response($output);
                    
            }else
            {
                
                    $output.="No Data";

                        return Response($output);
                //return dd("NO");
                //return Response()->json(['no'=>'Not found']);
            }   
        }
    } 

    public function companysearch(Request $request){

    	if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);
            $auth = Auth::id();
            if($request->companysearch == null){
                $customers = manager::where('company_user.user_id','=',$auth)
                ->join('company','company_user.company_id','=','company.id')
                ->join('plan', 'company.com_plan_id','=', 'plan.id')
                ->join('users','company.com_sales_id','=','users.id')
                ->join('status','company.company_status','=','status.id')
               // ->join('comapny_user','company_user.company_id','=','comapny.id')
               // ->where('comapny_user','comapny_user.user_id','=',$auth)
                ->select('company.*','plan.plan_name','users.name','status.status_name')
                ->orderBy('company.id','desc')
                ->get();
            
            }
            else
            {

               $customers = company::join('plan', 'company.com_plan_id','=', 'plan.id')
                ->join('users','company.com_sales_id','=','users.id')
                ->join('status','company.company_status','=','status.id')
                ->select('company.*','plan.plan_name','users.name','status.status_name')
                ->where('company_name','LIKE','%'.$request->companysearch.'%')
                ->orWhere('company_EIN','LIKE','%'.$request->companysearch.'%')
                ->orWhere('company_engname','LIKE','%'.$request->companysearch.'%')
                ->orderBy('company.id','desc')
                ->get();
            }              

            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../company/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->company_create.
                                '</div>'.
                            
                            '<div class="col-md-4" style="border-right:1px solid black;">'. 
                                $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->plan_name.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->status_name.
                            '</div>'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->name.
                            '</div>'.
                                    
                            '</div>'.                           
                        '</div>'.       
                    '</div>';
                                     
                }
                    return Response($output);
                    
            }else
            {
                
                    $output.="No Data";

                        return Response($output);
                //return dd("NO");
                //return Response()->json(['no'=>'Not found']);
            }   
        }


    }

    public function loadtrash(Request $request){

      if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);

            $customers = company::onlyTrashed()
                ->orderBy('company.id','desc')
                ->get();
                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../company/viewtrash/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->company_create.
                                '</div>'.
                            
                            '<div class="col-md-4" style="border-right:1px solid black;">'. 
                                $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_name.
                            '</div>'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_name.
                            '</div>'.
                                    
                            '</div>'.                           
                        '</div>'.       
                    '</div>';
                                     
                }
                    return Response($output);
                    
            }else
            {
                
                    $output.="No Data";

                        return Response($output);
                //return dd("NO");
                //return Response()->json(['no'=>'Not found']);
            }   
        }
    }   

}
