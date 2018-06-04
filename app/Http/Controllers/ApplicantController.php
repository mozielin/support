<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Auth;
use App\contract;
use App\company;
use App\contract_file;
use Input;
use App\plan;
use App\applicant;

class ApplicantController extends Controller
{
    public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index(){

        //$ip = \Request()->ip();

        //return dd($ip);
		$applicant = applicant::join('company','company_applicant.company_id','=','company.id')
								->select('company_applicant.*','company.company_name')
								->orderBy('company_applicant.id','desc')->paginate(5);
        $vip = 0;

        $count = applicant::count();
		return view('applicant.applicant_all',['applicant' => $applicant,'vip' => $vip])
                ->with('count',$count); 
	}

	public function view($id){

        $data = applicant::join('company','company_applicant.company_id','=','company.id')
        					  ->join('users','company_applicant.company_applicant_builder','=','users.id')
        					  ->select('company_applicant.*','company.company_name','users.name')
        					  ->find($id);

        //return dd($data);

        return view('applicant.applicant_view')
                ->with('data',$data);                
    }

    public function views($id){

        $data = applicant::join('company','company_applicant.company_id','=','company.id')
                              ->join('users','company_applicant.company_applicant_builder','=','users.id')
                              ->select('company_applicant.*','company.company_name','users.name')
                              ->find($id);

        //return dd($data);

        return view('applicant.applicant_views')
                ->with('data',$data);                
    }

	public function create(){
           $data = company::all();
           $company = company::all();
           $plandata = plan::all();
           //return dd($company);
           
           //return dd($num);
           return view('applicant.applicant_create')
                    ->with('data',$data)
                    ->with('company',$company);
        }

    public function create_by($id){

           $applicant = applicant::join('company','company_applicant.company_id','=','company.id')
        					  ->join('users','company_applicant.company_applicant_builder','=','users.id')
        					  ->select('company_applicant.*','company.company_name','users.name')
        					  ->find($id);
        	$company = company::select('company.company_name','company.id')->find($id);
           //return dd($applicant);
           return view('applicant.applicant_create_by')
                    ->with('company',$company);
        }    

    public function edit($id){
           $data = applicant::join('company','company_applicant.company_id','=','company.id')
        					  ->join('users','company_applicant.company_applicant_builder','=','users.id')
        					  ->select('company_applicant.*','company.company_name','users.name')
        					  ->find($id);
           
           //return dd($num);
           return view('applicant.applicant_edit')
                    ->with('data',$data);
        }

    public function store(Request $request)
    {
        //return dd($request);
            $validator = Validator::make($request->all(),[
                            'company_id' => 'required|max:20',
                            'applicant_name' => 'required',   
                            'company_applicant_email' => 'required'              
                            ]);
                        //驗證失敗回傳資料及錯誤訊息
                        if ($validator->fails()){
                            return redirect('applicant/create')
                                    ->withErrors($validator)
                                    ->withInput();
                        }
            $data = new applicant;
            $data->company_id = $request->company_id;
            $data->company_applicant_dep = $request->company_applicant_dep;
            $data->applicant_name = $request->applicant_name;
            $data->company_applicant_title = $request->company_applicant_title;
            $data->company_applicant_email = $request->company_applicant_email;
            if ($request->has('company_applicant_email2')) {
                $data->company_applicant_email2 = $request->company_applicant_email2;
            }
            $data->company_applicant_builder = $request->company_applicant_builder;
            if ($request->has('company_applicant_phone')) {
                $data->company_applicant_phone = $request->company_applicant_phone;
            }
            if ($request->has('company_applicant_mobile')) {
                $data->company_applicant_mobile = $request->company_applicant_mobile;
            }
            if ($request->has('applicant_note')) {
                $data->applicant_note = $request->applicant_note;
            }
            if ($request->has('vip')) {
                $data->vip = $request->vip;
            }
            $data->save();

            if($request->create_by==1){
            return redirect()->action('CompanyController@view',$data->company_id);    
            }
            else
            {
            return redirect()->action('ApplicantController@index');    
            }

            
              
    }    

    public function update(Request $request,$id){

		$data = applicant::find($id);

        $data->company_applicant_dep = $request->company_applicant_dep;
        $data->applicant_name = $request->applicant_name;
        $data->company_applicant_title = $request->company_applicant_title;
        $data->company_applicant_email = $request->company_applicant_email;
        if ($request->has('company_applicant_email2')) {
                $data->company_applicant_email2 = $request->company_applicant_email2;
            }
        if ($request->has('company_applicant_phone')) {
                $data->company_applicant_phone = $request->company_applicant_phone;
            }
        if ($request->has('company_applicant_mobile')) {
                $data->company_applicant_mobile = $request->company_applicant_mobile;
            }
        if ($request->has('applicant_note')) {
                $data->applicant_note = $request->applicant_note;
            }  
        if ($request->has('vip')) {
                $data->vip = $request->vip;
            }
        $data -> save();

        return redirect()->action('ApplicantController@view',$data->id);

	}

	public function delete($id){

		applicant::destroy($id);
		return redirect()->action('ApplicantController@index');
        }


    public function loadapplicant(Request $request){

        if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);

            $auth = Auth::id();

            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope')){

                    $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                                  ->select('company_applicant.*','company.company_name')
                                  ->orderBy('company_applicant.id','desc')
                                  ->get();
            }
            else{

                    $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                                  ->join('company_user','company_user.company_id','=','company.id')
                                  ->where('company_user.user_id','=',$auth)
                                  ->select('company_applicant.*','company.company_name')
                                  ->orderBy('company_applicant.id','desc')
                                  ->get();
            }
                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../applicant/views/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.
 
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->applicant_name.
                                '</div>'.   

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_applicant_phone.
                            '</div>'.

                            '<div class="col-md-4" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_applicant_email.
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

    public function vip(Request $request){

        if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);

            $auth = Auth::id();

            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope')){

                    $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                                  ->select('company_applicant.*','company.company_name')
                                  ->where('company_applicant.vip','=','1')
                                  ->orderBy('company_applicant.id','desc')
                                  ->get();
            }
            else{

                    $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                                  ->join('company_user','company_user.company_id','=','company.id')
                                  ->where('company_user.user_id','=',$auth)
                                  ->where('company_applicant.vip','=','1')
                                  ->select('company_applicant.*','company.company_name')
                                  ->orderBy('company_applicant.id','desc')
                                  ->get();
            }
                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../applicant/views/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.
    
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->applicant_name.
                                '</div>'.   

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_applicant_phone.
                            '</div>'.

                            '<div class="col-md-4" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_applicant_email.
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

    public function applicantsearch(Request $request){

        if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);

             $auth = Auth::id();

            if($request->applicantsearch == null){
            $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                          ->join('company_user','company_user.company_id','=','company.id')
                          ->where('company_user.user_id','=',$auth)
                          ->select('company_applicant.*','company.company_name')
                          ->orderBy('company_applicant.id','desc')
                          ->get();
            }
            elseif(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope')){
                $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                          ->select('company_applicant.*','company.company_name')
                          ->where('company_name','LIKE','%'.$request->applicantsearch.'%')
                          ->orWhere('applicant_name','LIKE','%'.$request->applicantsearch.'%')
                          ->orderBy('company_applicant.id','desc')
                          ->get();
            }
            else
            {
            $customers = applicant::join('company', 'company_applicant.company_id','=', 'company.id')
                          ->join('company_user','company_user.company_id','=','company.id')
                          ->where('company_user.user_id','=',$auth)
                          ->where(function ($query) use ($request) {
                              $query->where('company_name','LIKE','%'.$request->applicantsearch.'%')
                                    ->orWhere('applicant_name','LIKE','%'.$request->applicantsearch.'%');
                            })
                          ->select('company_applicant.*','company.company_name')
                          ->orderBy('company_applicant.id','desc')
                          ->get();
                            //return dd($customers);  
            }
                           
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../applicant/views/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.
            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->company_name.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->applicant_name.
                                '</div>'.   

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_applicant_phone.
                            '</div>'.

                            '<div class="col-md-4" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->company_applicant_email.
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
