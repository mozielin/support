<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\User;
use View;
use App\server;
use App\company;
use App\license_mac;

use Illuminate\Support\Facades\Auth;

class ServerController extends Controller
{
    public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}

    public function index(){

        $count = server::count();

		return view('server.server_all')
                ->with('count',$count); 
	}	

 	public function create(){
	
	return view('server.server_create');
	}	

    public function create_by($id){

        $macaddress = license_mac::join('license','license_mac.license_id','=','license.id')
                                 ->join('company','license.company_id','=','company.id')
                                 ->where('status_id','=','16')
                                 ->where('company.id','=',$id)
                                 ->select('company.company_name','company.id','license_mac.mac')
                                 ->get();
        $company = company::find($id);                  
        //return dd($macaddress);
    return view('server.server_create_by')->with('macaddress',$macaddress)
                                          ->with('company',$company);
    }

	public function view($id){

        $data = server::join('users','company_server_info.company_server_builder','=','users.id')
                        ->join('company','company_server_info.company_server','=','company.id')
                        ->select('company_server_info.*','users.name','company.company_name')->find($id);
        $update = server::join('users','company_server_info.company_server_update','=','users.id')->select('company_server_info.company_server_update','users.name')->find($id);

        if($update==null){
            $updateby = 'None';
        }
        else{
            $updateby = $update->name;
        }

        //return dd($updateby);

        return view('server.server_view')
                ->with('data',$data)
                ->with('updateby',$updateby);                
    }

    protected function store(Request $request)
    {    	
    	
    	/*$validator = Validator::make($request->all(),[
				'server_name' => 'required|string|max:255',
            	'company_server_type' => 'required|string|max:255',
            	
            	'company_server_extip' => 'required|ip|max:55',
            	'company_server_interip' => 'required|ip|max:55',            	
				]);
    		$company = $request->company_server;
			if ($validator->fails()){
				return redirect()->action('ServerController@create',$company)
						->withErrors($validator)
						->withInput();
			}*/
		
            /*儲存
            $validator = Validator::make($request->all(),[
                        'server_name' => 'required|max:20', 
                        'company_version_num' => 'integer'                  
                                ]);
                            //驗證失敗回傳資料及錯誤訊息
                            if ($validator->fails()){
                                return redirect('server/create_by')
                                        ->withErrors($validator)
                                        ->withInput();
                            }*/
			$data = new server;
            $data -> server_name = $request->server_name;
			$data -> company_business_code = $request->company_business_code;
			$data -> company_server_mac = $request->company_server_mac;
			$data -> company_version_num = $request->company_version_num;
			$data -> company_server_extip = $request->company_server_extip;
			$data -> company_server_interip = $request->company_server_interip;
			$data -> company_server_type = $request->company_server_type;		
			$data -> company_server = $request->company_server;
			$data -> company_server_builder = $request->company_server_builder;
            $data -> build_type = $request->build_type;
            $data -> URL = $request->URL;
			$data -> save();
            
            if($request->create_by==1){
            return redirect()->action('CompanyController@view',$data->company_server);    
            }
            else
            {
            return redirect()->action('ServerController@index');    
            }
            
    }
	
	public function edit($id){

        $data = server::join('users','company_server_info.company_server_builder','=','users.id')->select('company_server_info.*','users.name')->find($id);

        return view('server.server_edit')->with('data',$data);
		
	}

	
	
	public function update(Request $request,$id){

		$data = server::find($id);

        $data -> server_name = $request->server_name;
        $data -> company_business_code = $request->company_business_code;
        $data -> company_server_mac = $request->company_server_mac;
        $data -> company_version_num = $request->company_version_num;
        $data -> company_server_extip = $request->company_server_extip;
        $data -> company_server_interip = $request->company_server_interip;
        $data -> company_server_type = $request->company_server_type;
        $data -> company_server_update = $request->company_server_update;
        $data -> build_type = $request->build_type;
        $data -> URL = $request->URL;       
        $data -> save();

        return redirect()->action('ServerController@view',$data->id);

	}

	public function delete($id){

        $server = server::find($id);

        $backid = $server->company_server;

		server::destroy($id);
		//return redirect()->action('ServerController@index');
        return redirect()->route('company_view', [$backid]);
        }


    public function loadserver(Request $request){

        if($request->ajax())
        {
            $output="";

            //$searchdata=patch::all()->paginate(10);

            $auth = Auth::id();

            if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope') || Auth::user()->can('unlimited')){

                $searchdata = server::orderBy('id','desc')
                                    ->get();
            }
            else{

                $searchdata = server::join('company_user','company_user.company_id','=','company_server_info.company_server')
                            ->where('company_user.user_id','=',$auth)
                                ->orderBy('id','desc')
                                ->get();
            }

           /* $searchdata = manager::where('company_user.user_id','=',$auth)
                ->join('company','company_user.company_id','=','company.id')
                ->join('company_server_info','company_server_info.company_server','=','company.id')
               // ->join('comapny_user','company_user.company_id','=','comapny.id')
               // ->where('comapny_user','comapny_user.user_id','=',$auth)
                //->orderBy('company_server_info.id','desc')
                ->get();*/
            
                            //return dd($searchdata);                 
            if($searchdata)
            {
                foreach($searchdata as $key => $data)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../server/view/'.$data->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $data->company_server_type.
                                '</div>'.
                            
                            '<div class="col-md-2" style="border-right:1px solid black;">'. 
                                $data->server_name.
                                '</div>'.   

                            '<div class="col-md-6">'.   
                                    $data->URL.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $data->sync_ver.
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

    public function serversearch(Request $request){

        if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);

            $auth = Auth::id();

            if($request->serversearch == null){

            $searchdata = server::join('company_user','company_user.company_id','=','company_server_info.company_server')
                                ->where('company_user.user_id','=',$auth)
                                ->orderBy('id','desc')
                                ->get();
            }
            elseif(Auth::user()->hasRole('admin') || Auth::user()->hasRole('devenlope') || Auth::user()->can('unlimited')){
            $searchdata = server::where('server_name','LIKE','%'.$request->serversearch.'%')
                            ->orWhere('company_server_interip','LIKE','%'.$request->serversearch.'%')
                            ->orWhere('company_server_extip','LIKE','%'.$request->serversearch.'%')
                            ->orderBy('id','desc')
                            ->get();     
            }
            else
            {
            $searchdata = server::join('company_user','company_user.company_id','=','company_server_info.company_server')
                                ->where('company_user.user_id','=',$auth)
                                ->where(function ($query) use ($request) {
                                    $query->where('server_name','LIKE','%'.$request->serversearch.'%')
                                          ->orWhere('company_server_interip','LIKE','%'.$request->serversearch.'%')
                                          ->orWhere('company_server_extip','LIKE','%'.$request->serversearch.'%');
                                })
                                ->groupBy('id')
                                ->orderBy('id','desc')
                                ->get();
            }              
                            //return dd($customers);                 
            if($searchdata)
            {
                foreach($searchdata as $key => $data)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../server/view/'.$data->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $data->company_server_type.
                                '</div>'.
                            
                            '<div class="col-md-2" style="border-right:1px solid black;">'. 
                                $data->server_name.
                                '</div>'.   

                            '<div class="col-md-6">'.   
                                    $data->URL.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $data->sync_ver.
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
