<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

use Auth;

use Carbon\Carbon;

use App\bulletin;

use View;

class BulletinController extends Controller
{


	public function __construct(){
		    //Auth認證
    		$this->middleware('auth');
    		
		}

		
    public function index()
	{		
			
		return view('bulletin.bulletin_all');

	}

    public function create(){
		
		return view('bulletin.bulletin_create');

	}

	protected function store(Request $request)
    {    	

    
            //儲存USER
			$data = new bulletin;
			$data -> bulletin_name = $request->bulletin_name;
			$data -> bulletin_content = $request->bulletin_content;

			$data -> builder = $request->builder;
			$data -> save();
			\Session::flash('flash_message', '新增成功!');
          
			return redirect()->action('BulletinController@index');
        
       
    }

    public function view($id){
		
		$data = bulletin::join('users','bulletin.builder','=','users.id')
		                 ->select('bulletin.*','users.name')->find($id);
		//return dd($data);

		return view('bulletin.bulletin_view')
				->with('data',$data);

	}

	protected function update(Request $request)
    {    	

    
            //儲存USER
			$data = bulletin::find($request->id);
			$data -> bulletin_name = $request->bulletin_name;
			$data -> bulletin_content = $request->bulletin_content;
			$data -> company_tlc_end = $request->company_tlc_end;
			$data -> updateby = $request->updateby;
			$data -> save();
           
			return redirect()->action('BulletinController@index');
        
       
    }

	public function edit($id){
		

        $data = bulletin::join('users','bulletin.builder','=','users.id')
		                 ->select('bulletin.*','users.name')->find($id);

		return view('bulletin.bulletin_edit')
				->with('data',$data);
      
	}

	public function delete($id){

		//seadmin::destroy($id);
		$data = bulletin::find($id);
		$data -> delete(); 
		return redirect()->action('BulletinController@index');
        }

	public function loadindex(Request $request){
					
		if($request->ajax())
		{
			$output="";

			$customers = bulletin::join('users','bulletin.builder','=','users.id')
		                 ->select('bulletin.*','users.name')
		                 ->orderBy('id','DESC')->get();

			if($customers)
			{	
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../bulletin/view/'.$customer->id.'\' ">'.

						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->id.
								'</div>'.
							
							'<div class="col-md-4" style="border-right:1px solid black;">'.	
								$customer->bulletin_name.
								'</div>'.	

							'<div class="col-md-3">'.	
									$customer->created_at.
								'</div>'.	

							'<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.	
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





}
