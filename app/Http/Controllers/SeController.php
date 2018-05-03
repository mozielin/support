<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

use Auth;

use Carbon\Carbon;

use App\seadmin;

use View;

use App\license;
use App\functions;

class SeController extends Controller
{
    public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index()
	{		
			$od = 0 ;
		    \View::share('od', $od);
	
		return view('seadmin.seadmin_all');
	}

	public function loadindex(Request $request){

		
					
		if($request->ajax())
		{
			$output="";

			$customers = seadmin::join('users','seadmin.builder','=','users.id')
		                 ->select('seadmin.*','users.name')->orderBy('id','DESC')->get();	    

			if($customers)
			{	
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../seadmin/edit/'.$customer->id.'\' ">'.

						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-4" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->company_name.
								'</div>'.
							
							'<div class="col-md-3" style="border-right:1px solid black;">'.	
								$customer->company_tlc_start.
								'</div>'.	

							'<div class="col-md-3">'.	
									$customer->company_tlc_end.
								'</div>'.	

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
									$customer->name.
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
//return Response::view('patch_all')->header('Content-Type',$output);
	}

	public function loadbytime(Request $request){

		//return dd($request);
					
		if($request->ajax())
		{
			$output="";

			$customers = seadmin::
		                 join('users','seadmin.builder','=','users.id')
		                 ->select('seadmin.*','users.name')
		                 ->orderBy('seadmin.company_tlc_end','ASC')->get();

		    

			if($customers)
			{	
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../seadmin/edit/'.$customer->id.'\' ">'.

						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-4" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->company_name.
								'</div>'.
							
							'<div class="col-md-3" style="border-right:1px solid black;">'.	
								$customer->company_tlc_start.
								'</div>'.	

							'<div class="col-md-3">'.	
									$customer->company_tlc_end.
								'</div>'.	

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
									$customer->name.
							'</div>'.
									
							'</div>'.              				
						'</div>'.		
					'</div>';
				

						
				}	//return dd($output);//return Response::view('patch_all')->header('Content-Type',$output);
					return Response($output);

					//return view('patch_all',['customers' => $customers]);
					
			}else
			{
				return Response()->json(['no'=>'Not found']);
			}	
		}
//return Response::view('patch_all')->header('Content-Type',$output);
	}



	public function create(){
		
	return view('seadmin.seadmin_create');

	}	

	public function view($id){
		
		$data = seadmin::find($id)
		                 ->join('users','seadmin.builder','=','users.id')
		                 ->select('seadmin.*','users.name')->get();

	return view('seadmin.seadmin_view')
				->with('data',$data);

	}	

	protected function store(Request $request)
    {    	

    	$validator = Validator::make($request->all(),[
				'company_name' => 'required|string|max:255',
            	'company_tlc_start' => 'required|date',
            	'company_tlc_end' => 'required|date',
            	
				]);

			if ($validator->fails()){
				return redirect('seadmin/create')
						->withErrors($validator)
						->withInput();
			}
            //儲存USER
			$data = new seadmin;
			$data -> company_name = $request->company_name;
			$data -> company_tlc_start = $request->company_tlc_start;
			$data -> company_tlc_end = $request->company_tlc_end;
			$data -> builder = $request->builder;
			$data -> save();
           
			return redirect()->action('SeController@index');
        
       
    }
	
	protected function update(Request $request)
    {    	

    
            //儲存USER
			$data = seadmin::find($request->id);
			$data -> company_name = $request->company_name;
			$data -> company_tlc_start = $request->company_tlc_start;
			$data -> company_tlc_end = $request->company_tlc_end;
			$data -> builder = $request->builder;
			$data -> save();
           
			return redirect()->action('SeController@index');
        
       
    }

	public function edit($id){
		

        $data = seadmin::join('users','seadmin.builder','=','users.id')
		                 ->select('seadmin.*','users.name')->find($id);

		return view('seadmin.seadmin_edit')
				->with('data',$data);
      
	}

	public function delete($id){

		//seadmin::destroy($id);
		$data = seadmin::find($id);
		$data -> delete(); 
		return redirect()->action('SeController@index');
        }

	public function seadminsearch(Request $request)
		{
				

			if($request->ajax())
			{	

				$output="";

				
				$customers = seadmin::where('company_name','LIKE','%'.$request->seadminsearch.'%')
		                 ->join('users','seadmin.builder','=','users.id')
		                 ->select('seadmin.*','users.name')->get();		                 	
				
				if($customers)
				{
					foreach($customers as $key => $customer)
					{
						$output.= 
						  
						'<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../seadmin/edit/'.$customer->id.'\' ">'.
						


							'<div class="panel-heading " style="height:100%;">'.				
								'<div class="row" style="text-align:center;">'.

								'<div class="col-md-4" style="border-right:1px solid black; border-left:1px solid black;">'.	
									 $customer->company_name.
									'</div>'.
								
								'<div class="col-md-3" style="border-right:1px solid black;">'.	
									$customer->company_tlc_start.
									'</div>'.	

								'<div class="col-md-3">'.	
										$customer->company_tlc_end.
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

	

	public function seadmin_tlc(Request $request)
    {   
    	//return dd($request);
        $term = $request->seadmin_tlc;//jquery

        //return dd($term);
               $data = seadmin::join('company','seadmin.company_name','=','company.company_name')
                        ->select('seadmin.*','company.company_name')
                        ->where('company.company_name','=',$term)
                        ->first();
  	//return dd($data);

        $results=array();
        
            $results[] = ['id' => $data->id,'name'=>$data->company_name,'start' => $data->company_tlc_start,'end' => $data->company_tlc_end];
            //return dd($results);
        
        return response()->json($results);
    	

	}

	public function uploadlic(){
		return view('seadmin.seadmin_uploadlic');
	}

	public function licscan(Request $request){

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
        $mac = 0;
        $avmod = 0;
        $servermac = array();
        $modarray = array();

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

                $request->session()->put($num1, $address);
                $function = functions::all();

                sscanf($filename,"%[^.]",$lic_name);
                //return($address);
                return view('seadmin.seadmin_lic')
                    ->with('function',$function)
                    ->with('address',$address)
                    ->with('modarray',$modarray)
                    ->with('servermac',$servermac)
                    ->with('lic_name',$lic_name)
                    ->with('start',$start)
                    ->with('clientlimit',$clientlimit)
                    ->with('end',$end)
                    ->with('filename',$filename)
                    ->with('filepath',$num1);   
    }

    public function cancellic($filepath)
    {

        Storage::delete("/public/license/$filepath");

        return redirect()->action('SeController@uploadlic');

    }

}
