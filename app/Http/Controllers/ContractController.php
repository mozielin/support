<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\contract;
use App\company;
use App\contract_file;
use Input;
use App\plan;
use App\status;
use App\Receipt;
use App\manager;

use DB;

class ContractController extends Controller
{
    //
	public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index(){

        $count = contract::count();

        return view('contract.contract_all')
                ->with('count',$count); 
	}	

    public function view($id){

        $data = contract::join('company','company_contract.company_contract','=','company.id')
                ->join('users','company_contract.company_contract_builder','=','users.id')
                ->join('plan','company_contract.contract_plan','=','plan.id')
                ->join('status','company_contract.contract_status','=','status.id')
                ->select('company_contract.*','users.name','company.company_name','company.company_EIN','plan.plan_name','status.status_name')->find($id);
                //return dd($data);

        $update = contract::join('users','company_contract.contract_update','=','users.id')->select('company_contract.contract_update','users.name')->find($id);

        $contract_file = contract_file::where('contract_id','=',$id)->join('users','contract_file.file_builder','=','users.id')->select('contract_file.*','users.name')->orderBy('contract_file.id','desc')->get();

        $filenum = contract_file::where('contract_id','=',$id)->count();

        $receipt = receipt::where('contract_id','=',$id)->orderBy('id','desc')->get();

        $receiptnum = receipt::where('contract_id','=',$id)->count();

        //return dd($update);

        if($update==null){
            $updateby = 'None';
        }
        else{
            $updateby = $update->name;
        }

        return view('contract.contract_view')
                ->with('data',$data)
                ->with('updateby',$updateby)
                ->with('contract_file',$contract_file)
                ->with('filenum',$filenum)
                ->with('receipt',$receipt)
                ->with('receiptnum',$receiptnum);
    }

    public function edit($id){

        $data = contract::join('company','company_contract.company_contract','=','company.id')
                ->join('users','company_contract.company_contract_builder','=','users.id')
                ->join('plan','company_contract.contract_plan','=','plan.id')
                ->join('status','company_contract.contract_status','=','status.id')
                ->select('company_contract.*','users.name','company.company_name','company.company_EIN','plan.plan_name','status.status_name')
            
                ->find($id);
                //return dd($data);

        $update = contract::join('users','company_contract.contract_update','=','users.id')->select('company_contract.contract_update','users.name')->find($id);

        $contract_file = contract_file::where('contract_id','=',$id)->join('users','contract_file.file_builder','=','users.id')->select('contract_file.*','users.name')->orderBy('contract_file.id','desc')->get();

        $filenum = contract_file::where('contract_id','=',$id)->count();

        $plandata = plan::all();
        $class = "合約";
        $status = status::where('status_class','=',$class)->get();
        

        //return dd($update);

        if($update==null){
            $updateby = 'None';
        }
        else{
            $updateby = $update->name;
        }

        return view('contract.contract_edit')
                ->with('data',$data)
                ->with('updateby',$updateby)
                ->with('contract_file',$contract_file)
                ->with('filenum',$filenum)
                ->with('plandata',$plandata)
                ->with('status',$status);
    }

    public function show($data){
        //return Storage::allFiles('public');
        //$url = Storage::url($data);
        //$url = storage_path('app/public/contract/'.$data);
        //return dd($data);
        return "<pdf src='/storage/contract/$data'/>";
    }



    public function get(Request $request){
        //return dd($request);
        $company = company::all()->where('company_EIN','=',$request->company_EIN);
        $num  = 1;
        return view('contract.contract_create',['company' => $company,'num' => $num]); 
    }

    public function create(){
           $data = company::all();
           $company = company::all();
           $plandata = plan::all();
           $status = status::all();
           //return dd($company);
           
           //return dd($num);
           return view('contract.contract_create')
                    ->with('data',$data)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status);
        }

    public function create_by($id){

           $dataid = $id;
           $company = company::select('company.company_name','company.company_EIN','company.id')->find($id);
           $plandata = plan::all();
           $class = "合約";
           $status = status::where('status_class','=',$class)->get();
           
           //return dd($company);

           //return dd($num);
           return view('contract.contract_create_by')
                    ->with('dataid',$dataid)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status);
        }    
    
    public function upload(Request $request)
    {
        //return dd($request);
        $validator = Validator::make($request->all(),[
                'contract_title' => 'required',
                'company_name' => 'required',                
                'company_contract_start' => 'required',
                'company_contract_end' => 'required',
                'contract_quantity' => 'required|integer',
                'company_contract_date' => 'required',
                ]);

                //return dd ($request->files);
            //驗證失敗回傳資料及錯誤訊息
            if ($validator->fails()){
                return redirect('contract/create')
                        ->withErrors($validator)
                        ->withInput();
            }

            //return dd($request);

            $oldcontract = contract::where('company_contract','=',$request->company_id)
                                    ->orderBy('id','desc')->first();

            if( $oldcontract!= null){
                $oldcontract->contract_status = '4'; 
                $oldcontract->save();
            }
            
            //return dd($request->company_contract_check);
            //驗證欄位
            
            //資料儲存
            $contract = new Contract;
            $contract->contract_title = $request->contract_title;
            $contract->contract_status = $request->contract_status;
            $contract->contract_price = $request->contract_price;
            $contract->contract_quantity = $request->contract_quantity;
            $contract->contract_plan = $request->contract_plan; 
            $contract->company_contract_date = $request->company_contract_date;
            $contract->company_contract_start = $request->company_contract_start;
            $contract->company_contract_end = $request->company_contract_end;
            $contract->company_contract_check = $request->company_contract_check;
            $contract->company_contract = $request->company_id;
            $contract->company_contract_builder = $request->builder;
            $contract -> note = $request->note;

            $contract->save();

            $company = company::find($request->company_id);

            $company->com_plan_id = $request->contract_plan;

            $company->save();

                if($request->file('files')){
                    foreach($request->file('files') as $file) {
                        //return dd($file);

                        //附件檔名儲存
                        $filename = $file->getClientOriginalName();

                        $id = $contract->id;

                        $store = $file->store('public/contract');
                        
                        $path = sscanf($store,'public/contract/%s',$originfile);

                      //  $file->storeAs('public/contract',"$id$filename");
                        
                        $contract_file = new contract_file;
                        $contract_file->file_name = $filename;
                        $contract_file->contract_id = $contract->id;
                        $contract_file->file_builder = $request->builder;
                        $contract_file->origin_file = $originfile;
                        $contract_file->save();

                    }
                }

            return redirect()->action('CompanyController@view',$contract->company_contract); 
           
    }

    public function update(Request $request,$id)
    {
        //return dd($request);

        $contract = contract::find($id);

        $contract->contract_title = $request->contract_title;
        $contract->contract_status = $request->contract_status;
        $contract->contract_price = $request->contract_price;
        $contract->contract_quantity = $request->contract_quantity;
        $contract->company_contract_date = $request->company_contract_date;
        $contract->company_contract_start = $request->company_contract_start;
        $contract->company_contract_end = $request->company_contract_end;
        $contract->company_contract_check = $request->company_contract_check;
        $contract->contract_update = $request->contract_update;
        $contract->contract_plan = $request->contract_plan;
        $contract ->note = $request->note;


        $contract->save();

            if($request->file('files')){
                foreach($request->file('files') as $file) {
                    //return dd($file);
                    //附件檔名儲存
                    $filename = $file->getClientOriginalName();
                    $id = $contract->id;
                    $store = $file->store('public/contract');
                    $path = sscanf($store,'public/contract/%s',$originfile);
                        //return dd($request);
                    $contract_file = new contract_file;
                        $contract_file->file_name = $filename;
                        $contract_file->contract_id = $contract->id;
                        $contract_file->file_builder = $request->contract_update;
                        $contract_file->origin_file = $originfile;
                        $contract_file->save(); 
                    }
                }

        return redirect()->action('ContractController@view',$id);
    }


    public function filedelete($id){
        //return dd($id);
        $contract = contract_file::find($id);
        //return dd($contract);
        $contractid = $contract->contract_id;
        
        $deletename = $contract->origin_file;
        //return dd($deletename);
        Storage::delete("/public/contract/$deletename");

        contract_file::destroy($id);
        return redirect()->action('ContractController@edit',$contractid);
        
        
    }


    public function delete($id){

        $contract_file = contract_file::where('contract_id','=',$id)->get();


        foreach ($contract_file as $data) {
            $deletename = $data->file_name;
            Storage::delete("/public/contract/$deletename");
            contract_file::destroy($data->id);
        }

        $contract = contract::find($id);

        $backid = $contract->company_contract;

        contract::destroy($id);

        //return redirect()->action('CompanyController@view')->with('company_id',$backid);

        return redirect()->route('company_view', [$backid]);
       
    }

    public function contract_auto(Request $request)
    {   

        
        $term=$request->term;//jquery
        $data=company::where('company_name','LIKE','%'.$term.'%')
        ->take(10)
        ->get();
        $results=array();
        foreach($data as $v){
            $results[] = ['id' => $v->id,'value'=>$v->company_name,'EIN' => $v->company_EIN];
            //return dd($results);
        }
        return response()->json($results);
    }

    public function loadcon(Request $request){

        if($request->ajax())
        {
            $output="";

            $auth = Auth::id();

            //$customers=patch::all()->paginate(10);

            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope') || Auth::user()->can('unlimited')){
            
            $customers = contract::join('company','company_contract.company_contract','=','company.id')
                    ->join('plan','company_contract.contract_plan','=','plan.id')
                    ->join('status','company_contract.contract_status','=','status.id')
                    ->select('company_contract.*','company.company_name','plan.plan_name','status.status_name')
                    ->orderBy('id','desc')
                    ->get();
            }
            else{
                $customers = contract::join('company','company_contract.company_contract','=','company.id')
                    ->join('company_user','company_user.company_id','=','company.id')
                    ->join('plan','company_contract.contract_plan','=','plan.id')
                    ->join('status','company_contract.contract_status','=','status.id')
                    ->where('company_user.user_id','=',$auth)
                    ->select('company_contract.*','company.company_name','plan.plan_name','status.status_name')
                    ->orderBy('id','desc')
                    ->get();  
            }
                    /*
        $customers = manager::where('company_user.user_id','=',$auth)
                ->join('company','company_user.company_id','=','company.id') 
                ->join('plan', 'company.com_plan_id','=', 'plan.id')
                ->join('status','company.company_status','=','status.id')
                ->join('company_contract','company_contract.company_contract','=','company.id')    
               // ->join('comapny_user','company_user.company_id','=','comapny.id')
               // ->where('comapny_user','comapny_user.user_id','=',$auth)
                ->select('company_contract.*','company.company_name','plan.plan_name','status.status_name')
                ->get();
*/
    
                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../contract/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->company_name.
                                '</div>'.
                            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->contract_title.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black;">'.   
                                    $customer->contract_quantity.
                                '</div>'.  
                            '<div class="col-md-2">'.   
                                    $customer->company_contract_end.
                                '</div>'. 

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->status_name.
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


    public function contractsearch(Request $request)
    {
            //return dd($request);
        
        //->orWhere('company_contract_picture','LIKE','%'.$request->search_name. '%')

        if($request->ajax())
        {
            $output="";

            $auth = Auth::id();

            if($request->contractsearch == null ){
                $customers = manager::where('company_user.user_id','=',$auth)
                                    ->join('company','company_user.company_id','=','company.id')
                                    ->join('company_contract','company_contract.company_contract','=','company.id')
                                    ->join('plan','company_contract.contract_plan','=','plan.id')
                                    ->join('status','company_contract.contract_status','=','status.id')
                                    ->select('company_contract.*','company.company_name','plan.plan_name','status.status_name')
                                    ->orderBy('id','desc')
                                    ->get();
                
            }
            elseif(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope') || Auth::user()->can('unlimited')){
                $customers = contract::join('company','company_contract.company_contract','=','company.id')
                    ->join('plan','company_contract.contract_plan','=','plan.id')
                    ->join('status','company_contract.contract_status','=','status.id')
                    ->select('company_contract.*','company.company_name','plan.plan_name','status.status_name')
                    ->where('company_name','LIKE','%'.$request->contractsearch.'%')
                    ->orWhere('contract_title','LIKE','%'.$request->contractsearch.'%')
                    ->orWhere('plan_name','LIKE','%'.$request->contractsearch.'%')
                    ->orderBy('company_contract.id','desc')
                    ->get();
            }
            else
            {


                 $customers = DB::table('company_contract')
                        ->join('company','company_contract.company_contract','=','company.id')
                        ->join('company_user','company_user.company_id','=','company.id')
                        ->join('plan','company_contract.contract_plan','=','plan.id')
                        ->join('status','company_contract.contract_status','=','status.id')
                        ->where('company_user.user_id','=',$auth)
                        ->where(function ($query) use ($request) {
                              $query->where('company_name','LIKE','%'.$request->contractsearch.'%')
                                    ->orWhere('contract_title','LIKE','%'.$request->contractsearch.'%');
                        })
                        ->select('company_contract.*','company.company_name','plan.plan_name','status.status_name')
                        ->groupBy('id')
                        ->orderBy('id','desc')
                        ->get();
            }    

            //$customers=patch::all()->paginate(10);

            
                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {

                    
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../contract/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->company_name.
                                '</div>'.
                            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->contract_title.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black;">'.   
                                    $customer->company_contract_date.
                                '</div>'.  
                            '<div class="col-md-2">'.   
                                    $customer->company_contract_end.
                                '</div>'. 

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->status_name.
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

}
