<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Auth;

use App\company;
use App\license_mac;

use Input;
use App\plan;
use App\status;
use App\license;
use App\contract;
use App\functions;
use App\seadmin;

class LicController extends Controller
{

	//
	public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index(){

        $count = license::count();
		
		return view('license.license_all')
            ->with('count',$count); 
	}	

    public function view($id){

        $data = license::join('company','license.company_id','=','company.id')
                ->join('users','license.builder_id','=','users.id')
                ->join('status','license.status_id','=','status.id')
                ->join('company_contract','license.company_id','=','company_contract.company_contract')
                ->select('license.*','users.name','company.company_name','company.company_EIN','status.status_name','company_contract.contract_plan','company_contract.contract_status')->find($id);
                //return dd($data);  

        $update = license::join('users','license.update_id','=','users.id')->select('license.update_id','users.name')->find($id);
        $ldata = license::find($id)->functions;
        //return dd($ldata);
        $tlcdata = seadmin::where('lic_id','=',$id)->first();
        $function = functions::all();
        //return dd($tlcdata,$ldata,$function);

       // $license_file = license_file::where('license_id','=',$id)->join('users','license_file.file_builder','=','users.id')->select('license_file.*','users.name')->get();

        //$licensenum = license::where('company_id','=',$id)->count();

        //return dd($function);

        if($update==null){
            $updateby = 'None';
        }
        else{
            $updateby = $update->name;
        }

        $filepath = '/storage/license/'.$data->origin_file;
       // return dd($filepath);
        return view('license.license_view')
                ->with('data',$data)
                ->with('updateby',$updateby)
                ->with('filepath',$filepath)
                ->with('ldata',$ldata)
                ->with('tlcdata',$tlcdata)
                ->with('function',$function);
    }

    public function edit($id){

       $data = license::join('company','license.company_id','=','company.id')
                ->join('users','license.builder_id','=','users.id')
                ->join('status','license.status_id','=','status.id')
                ->join('company_contract','license.company_id','=','company_contract.company_contract')
                ->select('license.*','users.name','company.company_name','company.company_EIN','status.status_name','company_contract.contract_plan','company_contract.contract_status')->find($id);
                //return dd($data);

        $update = license::join('users','license.update_id','=','users.id')->select('license.update_id','users.name')->find($id);

        $class = "Lic";
        $statusdata = status::where('status_class','=',$class)->get();
        $function = functions::all();
        $ldata = license::find($id)->functions;

       // $tlc = seadmin::all()->where('company_name','=',$data->company_name)->first();

        //return dd($update);

        if($update==null){
            $updateby = 'None';
        }
        else{
            $updateby = $update->name;
        }

        return view('license.license_edit')
                ->with('data',$data)
                ->with('updateby',$updateby)
                ->with('statusdata',$statusdata)
                ->with('function',$function)
                //->with('tlc',$tlc)
                ->with('ldata',$ldata);
    }

    public function show($data){
        //return Storage::allFiles('public');
        //$url = Storage::url($data);
        //$url = storage_path('app/public/license/'.$data);
        //return dd($data);
        return "<image src='/storage/license/$data'/>";
    }



    public function get(Request $request){
        //return dd($request);
        $company = company::all()->where('company_EIN','=',$request->company_EIN);
        $num  = 1;
        return view('license.license_create',['company' => $company,'num' => $num]); 
    }

    public function create(){
     
           $data = company::all();
           $company = company::all();
           $plandata = plan::all();
           $class = "Lic";
           $status = status::where('status_class','=',$class)->get();
           $function = functions::all();

           
           //return dd($company);
           
           //return dd($num);
           return view('license.license_create')
                    ->with('data',$data)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status)
                    ->with('function',$function);
        }

    public function create_test(){
     
           $data = company::all();
           $company = company::all();
           $plandata = plan::all();
           $class = "Lic";
           $status = status::where('status_class','=',$class)->get();
           $function = functions::all();

           
           //return dd($company);
           
           //return dd($num);
           return view('license.license_create_test')
                    ->with('data',$data)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status)
                    ->with('function',$function);
        }

    public function create_by_old($id){

    		$dataid = $id;
           	$company = company::select('company.company_name','company.company_EIN','company.id')->find($id);
           	$plandata = plan::all();
           
           	$contract = contract::join('status','company_contract.contract_status','=','status.id')
                                ->join('plan','company_contract.contract_plan','=','plan.id')
                                ->where('company_contract','=',$id)
                                ->select('company_contract.*','plan.plan_name','status.status_name')
                                ->orderBy('id','DESC')->first();
           if ($contract) {
           		
           		$class = "Lic";
           		$status = status::where('status_class','=',$class)->get();
           		$function = functions::all();
           		return view('license.license_create_by')
                    ->with('dataid',$dataid)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status)
                    ->with('contract',$contract)
                    ->with('function',$function);
           } else {

           		$class = "合約";
           		$status = status::where('status_class','=',$class)->get();
           		\Session::flash('check_message', '該客戶沒有合約，請先建立!');
           		return view('contract.contract_create_by')
           			->with('dataid',$dataid)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status);
           }

           
        }    
    
    public function upload(Request $request)
    {

        $license = new license;
        $license->lic_name = $request->lic_name;
        $license->status_id = $request->status_id;
        $license->company_id = $request->company_id;
        $license->start_at = $request->start_at;
        $license->expir_at = $request->expir_at; 
        $license->builder_id = $request->builder_id;
               
        $license->save();

        if ($request->hasFile('lic')){
            //取得附件檔名
            $filename = $request->lic->getClientOriginalName();
            //新增LIC資料
                      
            //附件檔名儲存
            //return  dd($filename);
            $id = $license->id;   
            $request->file('lic')->storeAs('public/license',"$id$filename");
            $license = license::find($id);
            $license->lic_file = "$id$filename";
            $license->save();
    
        }

        //選購功能新增

        $function = functions::all();

        foreach ($function as $data)  
            {

                if($request->has($data->id)){
                    $license->functions()->detach($data->id);
                    $license->functions()->attach($data->id);
                }
                else{
                    $license->functions()->detach($data->id);
                    //return dd("NNN");
                }
        
            }
        //TLC功能儲存(新寫法)
        if($request->company_tlc_start != null){  
            $data = seadmin::firstOrCreate(
                ['company_name' => $request->tlc_company_name],
                ['company_tlc_start' => $request->company_tlc_start,
                 'company_tlc_end' => $request->company_tlc_end,
                 'builder' => $request->builder,]
            );
            //return dd($data);
            $data -> company_name = $request->tlc_company_name;
            $data -> company_tlc_start = $request->company_tlc_start;
            $data -> company_tlc_end = $request->company_tlc_end;
            $data -> com_id = $request->company_id;
            $data -> builder = $request->builder;
            $data -> save();
        }

        \Session::flash('flash_message', '新增成功!');

        return redirect()->action('CompanyController@view',$request->company_id);
    }

    public function update(Request $request,$id)
    {
        //return dd($request);

        
            //$filename = $request->image->getClientOriginalName();
            //$request->image->storeAs('public/license',$filename);            //return Storage::put('pubilc', $request->file('image'));
            //return dd($request);
                        //return dd($file);
                        
                        $validator = Validator::make($request->all(),[
                        'lic_name' => 'required',
                        'company_name' => 'required',               
                                ]);
                            //驗證失敗回傳資料及錯誤訊息
                            if ($validator->fails()){
                                return redirect('license/create')
                                        ->withErrors($validator)
                                        ->withInput();
                            }

                        $license = license::find($id);
                        $license->lic_name = $request->lic_name;
                        $license->status_id = $request->status_id;
                        $license->start_at = $request->start_at;
                        $license->expir_at = $request->expir_at; 
                        $license->update_id = $request->update_id;
                        //$license->lic_file = $filename;
                    
                        $license->save();
                

                if ($request->hasFile('lic')){
                        //return  dd($filename);
                        $id = $license->id;
                        $filename = $request->lic->getClientOriginalName();
                        $request->file('lic')->storeAs('public/license',"$id$filename");

                        $license = license::find($id);

                        $license->lic_file = "$id$filename";

                        $license->save();

                    }

                        $function = functions::all();


                        foreach ($function as $data)  
                        {

                            if($request->has($data->id)){
                                $license->functions()->detach($data->id);
                                $license->functions()->attach($data->id);
                            }
                            else{
                                $license->functions()->detach($data->id);
                                //return dd("NNN");
                            }
        
                        }

                        //TLC功能儲存(舊寫法)
                        if($request->has('tlc_company_name')){   

                        $data = seadmin::all()->where('company_name','=',$request->tlc_company_name)->first();
                        
                        if(!$data->first()){
                        //return dd("new");
                        $data = new seadmin;
                        $data -> company_name = $request->tlc_company_name;
                        $data -> company_tlc_start = $request->company_tlc_start;
                        $data -> company_tlc_end = $request->company_tlc_end;
                        $data -> builder = $request->builder;
                        $data -> save();
                        }
                        else{
                        //return dd("update");
                        $data -> company_name = $request->tlc_company_name;
                        $data -> company_tlc_start = $request->company_tlc_start;
                        $data -> company_tlc_end = $request->company_tlc_end;
                        $data -> builder = $request->builder;
                        $data -> save();
                        }
                        
                        }

        \Session::flash('flash_message', '修改成功!');
        return redirect()->action('LicController@view',$id);
    }


    public function filedelete($id){
        //return dd($id);
        $license = license_file::find($id);
        //return dd($license);
        $licenseid = $license->license_id;
        
        $deletename = $license->file_name;
        //return dd($deletename);
        Storage::delete("/public/license/$deletename");

        license_file::destroy($id);
        return redirect()->action('ContractController@edit',$licenseid);
        
        
    }


    public function delete($id){

            $data = license::find($id);
			$macdata = license_mac::where('license_id','=',$id)->first();
            $backid = $data->company_id;
			$macdata -> delete();
            $data -> delete(); 
    
            

        //return redirect()->action('LicController@index');

        return redirect()->route('company_view', [$backid]);
       
    }

    public function license_auto(Request $request)
    {   
        //return dd($request);
        
        $term=$request->term;//jquery
               $data=company::join('company_contract','company_contract.company_contract','=','company.id')
                        ->join('status','company_contract.contract_status','=','status.id')
                        ->join('plan','company_contract.contract_plan','=','plan.id')
                        ->select('company.*','status.status_name','plan.plan_name')
                        ->where('company_name','LIKE','%'.$term.'%')
                        ->groupby('company.id')
                        ->take(10)
                        ->get();
                       //return dd($data);

        $results=array();
        foreach($data as $v){
            $results[] = ['id' => $v->id,'value'=>$v->company_name,'EIN' => $v->company_EIN,'plan_name' => $v->plan_name,'status_name' =>$v->status_name];
            //return dd($results);
        }
        return response()->json($results);
    }

    public function loadlic(Request $request){

        if($request->ajax())
        {
            $output="";

             $auth = Auth::id();

            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope') || Auth::user()->can('unlimited')){

                    $customers = license::join('status','license.status_id','=','status.id')
                                    ->join('company','license.company_id','=','company.id')
                                    ->select('license.*','status.status_name')
                                    ->orderBy('license.id','DESC')
                                    ->get();
            }
            else{
                $customers = license::join('status','license.status_id','=','status.id')
                                    ->join('company','license.company_id','=','company.id')
                                    ->join('company_user','company.id','=','company_user.company_id')
                                    ->where('company_user.user_id','=',$auth)
                                    ->select('license.*','status.status_name')
                                    ->orderBy('license.id','DESC')
                                    ->get();

            }

            //$customers=patch::all()->paginate(10);

         
                           // return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../license/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-1" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->id.
                                '</div>'.
                            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->lic_name.
                                '</div>'.   

                            '<div class="col-md-3">'.   
                                    $customer->start_at.
                                '</div>'.   

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->expir_at.
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
                
                    $output.= 'Nono';



                        return Response($output);
                //return dd("NO");
                //return Response()->json(['no'=>'Not found']);
            }   
        }

    }


    public function licsearch(Request $request)
    {
            //return dd($request);
        
        //->orWhere('company_contract_picture','LIKE','%'.$request->search_name. '%')

        if($request->ajax())
        {
            $output="";

            $auth = Auth::id();

            if($request->licsearch == null){

            $customers = license::join('status','license.status_id','=','status.id')
                            ->join('company','license.company_id','=','company.id')
                            ->join('company_user','company.id','=','company_user.company_id')
                            ->where('company_user.user_id','=',$auth)
                            ->select('license.*','status.status_name')
                            ->orderBy('license.id','DESC')
                            ->get();
            }
            elseif(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope')){
            $customers = license::join('status','license.status_id','=','status.id')
                            ->join('company','license.company_id','=','company.id')
                            ->select('license.*','status.status_name')
                            ->where('company_name','LIKE','%'.$request->licsearch.'%')
                            ->orwhere('lic_name','LIKE','%'.$request->licsearch.'%')
                            ->get();
            }
            else
            {
            //$customers=patch::all()->paginate(10);
            $customers = license::join('status','license.status_id','=','status.id')
                            ->join('company','license.company_id','=','company.id')
                            ->join('company_user','company_user.company_id','=','company.id')
                            ->select('license.*','status.status_name','company_user.*')
                            ->where('company_user.user_id','=',$auth)
                            ->where(function ($query) use ($request) {
                              $query->where('company_name','LIKE','%'.$request->licsearch.'%')
                                    ->orwhere('lic_name','LIKE','%'.$request->licsearch.'%');
                            })
                            ->get();
            }

                            //return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {

                    
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../license/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-1" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->id.
                                '</div>'.
                            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->lic_name.
                                '</div>'.   

                            '<div class="col-md-3">'.   
                                    $customer->start_at.
                                '</div>'.   

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->expir_at.
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
                    'NONO';



                        return Response($output);
                //return dd("NO");
                //return Response()->json(['no'=>'Not found']);
            }   
        }
    }

    
public function upload_by($id){

                $dataid = $id;
            $company = company::select('company.company_name','company.company_EIN','company.id')->find($id);
            $plandata = plan::all();
           
            $contract = contract::join('status','company_contract.contract_status','=','status.id')
                                ->join('plan','company_contract.contract_plan','=','plan.id')
                                ->where('company_contract','=',$id)
                                ->select('company_contract.*','plan.plan_name','status.status_name')
                                ->orderBy('company_contract_end','DESC')->first();
           if ($contract) {
                
                $class = "Lic";
                $status = status::where('status_class','=',$class)->get();
                $function = functions::all();
                return view('license.license_create_by')
                    ->with('dataid',$dataid)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status)
                    ->with('contract',$contract)
                    ->with('function',$function);
           } else {

                $class = "合約";
                $status = status::where('status_class','=',$class)->get();
                \Session::flash('check_message', '該客戶沒有合約，請先建立!');
                return view('contract.contract_create_by')
                    ->with('dataid',$dataid)
                    ->with('company',$company)
                    ->with('plandata',$plandata)
                    ->with('status',$status);
           }

        
return view('license.license_create_by');


        
    }

    public function upload_create(Request $request){

        //return dd($request);
        $company_name = $request->company_name;
        $company_EIN = $request->company_EIN;
        $company_id = $request->company_id;

        if ($request->hasFile('lic')){
            //取得附件檔名
            $filename = $request->lic->getClientOriginalName();
          
                      
            //附件檔名儲存
         
            $store = $request->file('lic')->store('public/license');
            
            $path = sscanf($store,'public/license/%s',$num1);

            //return dd($num1);
            
        }

        //測試用
        $filepath = '../storage/app/public/license/lic.tpls';
        $samplepath = '../storage/app/public/license/sample.tpls';
        $sample2path = '../storage/app/public/license/sample2.tpls';

        $file = file_get_contents('../storage/app/public/license/'.$num1);

        //return dd($file);
        $sample = file_get_contents($samplepath);
        $sample2 = file_get_contents($sample2path);
        $string = explode("><", $file);
        //return dd($string);
        //$string2 = explode("><", $string[0]);
        //return dd($string2);
        //$ff = sscanf($string[0], $sample,$num1,$num2,$num3,$num4,$num5,$clientlimit,$start,$num5,$end);
        //return dd($clientlimit,$start,$end);
        $mac = 0;
        $avmod = 0;
        $servermac = array();
       
        
        $modarray = array();
        //$resultarray[$mac] = array('test'=>'123') ;

        foreach ($string as $key) {
            //return dd($key);
           $headline = sscanf($key,"%3s",$head); 
           //return dd($head);
           
            switch ($head) {
                case 'All':
                    $mac++;
                    $server = sscanf($key,"%*[^>]>%[^<]",${'serverMac'.$mac});
                    //return dd($serverMac1);

                    //array_push($servermac,${'serverMac'.$mac});'
                    $address['server'.$mac] =  ${'serverMac'.$mac};           
                    break;

                case 'Cli':
                    $limit = sscanf($key,"%*[^>]>%[^<]",$clientlimit);
                    //return dd($clientlimit);
                    break;

                case 'Beg':
                    $begin = sscanf($key,"%*[^>]>%[^ ]",$start);
                    //return dd($start);
                    break;

                case 'End':
                    $stop = sscanf($key,"%*[^>]>%[^ ]",$end);
                    //return dd($end);
                    break;

                case 'Ava':
                    $avmod++;
                    $mod = sscanf($key,$sample,${'modnum'.$avmod},${'start_mod'.$avmod},$nouse,${'end_mod'.$avmod});
                    //return dd(${'modnum'.$avmod},${'start_mod'.$avmod},$nouse,${'end_mod'.$avmod});
                    //array_push($modarray,${'modnum'.$avmod},${'start_mod'.$avmod},$nouse,${'end_mod'.$avmod});
                    $modarray[] = array('mod'=>${'modnum'.$avmod},${'start_mod'.$avmod},${'end_mod'.$avmod});
                    break;

                default:
                   
                    break;
           }    
        }
                   // $a = array(array('p', 'h'), array('p', 'r'), 'o');
                 
                    //$yoyo = array_search('2018-03-26',$modarray);
                   // if(in_array(array('mod'=>${'modnum'.$avmod},${'start_mod'.$avmod},${'end_mod'.$avmod}), $modarray)){
                   //     return dd("yes");
                   // }
                   // if (in_array(array('p'), $a)) {
                      //  return dd ("'ph' was found\n");
                   // }

                $request->session()->put($num1, $address);

                $company = company::select('company.company_name','company.company_EIN','company.id')->find($company_id);
           
           
                $contract = contract::join('status','company_contract.contract_status','=','status.id')
                                ->join('plan','company_contract.contract_plan','=','plan.id')
                                ->where('company_contract','=',$company_id)
                                ->select('company_contract.*','plan.plan_name','status.status_name')
                                ->orderBy('id','DESC')->first();
                   
                $plandata = plan::all();
                $class = "Lic";
                $status = status::where('status_class','=',$class)->get();
                $test = 0;
                $function = functions::orderBy('select','DESC')->orderBy('id','ASC')->get();
                //return dd($function);
                //foreach ($modarray as $moddata ) {
                //    foreach ($function as $fun) {
                //        if ($moddata['mod'] == $fun->code) {
                //            $functions[]
                //        }
                //    }
                    
                //}

                sscanf($filename,"%[^.]",$lic_name);
                //return dd($address,$modarray,$function);
                
                //return dd($company_name,$company_EIN,$company_id);
                return view('license.license_create_test')
                    ->with('plandata',$plandata)
                    ->with('status',$status)
                    ->with('function',$function)
                    ->with('address',$address)
                    ->with('modarray',$modarray)
                    ->with('servermac',$servermac)
                    ->with('lic_name',$lic_name)
                    ->with('contract',$contract)
                    ->with('start',$start)
                    ->with('clientlimit',$clientlimit)
                    ->with('end',$end)
                    ->with('test',$test)
                    ->with('filename',$filename)
                    ->with('filepath',$num1)
                    ->with('company_name',$company_name)
                    ->with('company_EIN',$company_EIN)
                    ->with('company_id',$company_id);   
    }

    public function upload_store(Request $request)
    {
        //return dd($request);
        $validator = Validator::make($request->all(),[
            'lic_name' => 'required',
            'company_name' => 'required',
            'company_id' => 'required' ,                
        ]);
            //驗證失敗回傳資料及錯誤訊息
        if ($validator->fails()){
            return redirect('license/create')
                ->withErrors($validator)
                ->withInput();
        }

        $license = new license;
        $license->lic_name = $request->lic_name;
        $license->status_id = $request->status_id;
        $license->company_id = $request->company_id;
        $license->start_at = $request->start_at;
        $license->expir_at = $request->expir_at; 
        $license->builder_id = $request->builder_id;
        $license->lic_file = $request->filename;
        $license->origin_file = $request->origin_file;
               
        $license->save();

        //存Mac
        $servermac = $request->session()->pull($request->origin_file, 'default');
        //return dd($servermac);

        foreach ($servermac as $macdata) {
            //return dd($macdata);
            $license_mac = new license_mac;
            $license_mac->mac = $macdata;
            $license_mac->license_id = $license->id;
            $license_mac->save(); 
        }
        //選購功能新增

        $function = functions::all();

        foreach ($function as $data)  
            {

                if($request->has($data->code)){
                	//return dd("code~",$data);
                    $license->functions()->detach($data->id);
                    //$license->functions()->attach($data->id);
                    $license->functions()->attach([$data->id => ['start_at'=>$request->start[$data->code], 'end_at'=>$request->end[$data->code]]]);
                }
                else{
                    $license->functions()->detach($data->id);
                    //return dd("NNN");
                }
        
            }
        //TLC功能儲存(新寫法)
        if($request->company_tlc_start != null){  
            $data = seadmin::firstOrCreate(
                ['lic_id' => $license->id],
                ['company_name' => $request->tlc_company_name,
				 'company_tlc_start' => $request->company_tlc_start,
                 'company_tlc_end' => $request->company_tlc_end,
                 'com_id' => $request->company_id,
                 'builder' => $request->builder,]
            );
            //return dd($data);
            $data -> company_name = $request->tlc_company_name;
            $data -> company_tlc_start = $request->company_tlc_start;
            $data -> company_tlc_end = $request->company_tlc_end;
            $data -> lic_id = $license->id;
			$data -> com_id = $request->company_id;
            $data -> builder = $request->builder;
            $data -> type = '視訊會議';
            $data -> title = $request->lic_name;
            $data -> save();
        }

        \Session::flash('flash_message', '新增成功!');

        return redirect()->action('CompanyController@view',$request->company_id);
    }


    public function cancel($company_id,$filepath)
    {

        Storage::delete("/public/license/$filepath");

        return redirect()->action('LicController@upload_by',$company_id);

    }



}//結束符號
