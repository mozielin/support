<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

use Auth;

use App\Receipt;

use App\company;

use Carbon\Carbon;

use App\seadmin;

use View;

use App\license;

use App\contract;

use App\functions;

class ReceiptController extends Controller
{
    public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index()
	{			
		return view('receipt.receipt_all');
	}

	public function loadindex(Request $request){
					
		if($request->ajax())
		{
			$output="";

		    $customers = receipt::join('company','receipt.company_id','=','company.id')
						->join('company_contract','company_contract.id','=','receipt.contract_id')
		                ->select('receipt.*','company.company_name','company_contract.contract_title')->orderBy('id','DESC')->get();    

			if($customers)
			{	
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../receipt/view/'.$customer->id.'\' ">'.

						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->company_name.
								'</div>'.
							
							'<div class="col-md-3" style="border-right:1px solid black;">'.	
								$customer->contract_title.
								'</div>'.	

							'<div class="col-md-3">'.	
									$customer->rcpnum.
								'</div>'.	

							'<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.	
									$customer->rcpdate.
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

	}

	public function create($id){
		
		$contract = contract::join('company','company_contract.company_contract','=','company.id')
		                        ->where('company_contract.id','=',$id)
								->select('company_contract.*','company.company_name')->first();
		
		//return dd($contract);
		
	return view('receipt.receipt_create')
					->with('contract',$contract);

	}	

	public function view($id){
		
		$data = receipt::join('company','receipt.company_id','=','company.id')
						->join('company_contract','company_contract.id','=','receipt.contract_id')
						->join('users','receipt.builder','=','users.id')
		                 ->select('receipt.*','company.company_name','company_contract.contract_title','users.name')->find($id);

		                 //return dd($data);
	return view('receipt.receipt_view')
				->with('data',$data);

	}

	protected function store(Request $request)
    {    	
    		//return dd($request);

    		//驗證欄位
			$validator = Validator::make($request->all(),[
				'rcpdate' => 'required',				
		        'rcpnum' => 'required',
		        'price' => 'required|numeric'
						]);
					//驗證失敗回傳資料及錯誤訊息
					if ($validator->fails()){
						return redirect('receipt/create/'.$request->contract_id)
								->withErrors($validator)
								->withInput();
					}

            //儲存
			$data = new receipt;
			$data -> rcpdate = $request->rcpdate;
			$data -> rcpnum = $request->rcpnum;
			$data -> price = $request->price;
			$data -> note = $request->note;
			$data -> contract_id = $request->contract_id;
			$data -> company_id = $request->com_id;
			$data -> builder = $request->builder;
			$data -> save();
           
			return redirect()->action('ContractController@view',$request->contract_id);
        
      
    }
	
	protected function update(Request $request)
    {    	

            //儲存USER
			$data = receipt::find($request->id);
			$data -> rcpdate = $request->rcpdate;
			$data -> rcpnum = $request->rcpnum;
			$data -> price = $request->price;
			$data -> note = $request->note;
			$data -> updater = $request->updater;
			$data -> save();
           
			return redirect()->action('ReceiptController@view',$request->id);
        
       
    }

	public function edit($id){

        $data = receipt::join('company','receipt.company_id','=','company.id')
					   ->join('company_contract','company_contract.id','=','receipt.contract_id')
					   ->join('users','receipt.builder','=','users.id')
		               ->select('receipt.*','company.company_name','company_contract.contract_title','users.name')
		               ->find($id);

		                 //return dd($data);
	return view('receipt.receipt_edit')
				->with('data',$data);
      
	}

	public function delete($id){

		$data = receipt::find($id);
		$backid = $data->contract_id;
		$data -> delete(); 
		return redirect()->action('ContractController@view',$backid);
        }

	public function receiptsearch(Request $request)
		{
				

			if($request->ajax())
			{	

				$output="";

				
				$customers = receipt::join('company','receipt.company_id','=','company.id')
						 ->join('company_contract','company_contract.id','=','receipt.contract_id')
						 ->where('company_name','LIKE','%'.$request->receiptsearch.'%')
						 ->orWhere('rcpnum','LIKE','%'.$request->receiptsearch.'%')
		                 ->select('receipt.*','company.company_name','company_contract.contract_title')->orderBy('id','DESC')->get();	   
				
				if($customers)
			{	
				foreach($customers as $key => $customer)
				{
					$output.=
					'<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../receipt/view/'.$customer->id.'\' ">'.

						'<div class="panel-heading " style="height:100%;">'.				
							'<div class="row" style="text-align:center;">'.

							'<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.	
								 $customer->company_name.
								'</div>'.
							
							'<div class="col-md-3" style="border-right:1px solid black;">'.	
								$customer->contract_title.
								'</div>'.	

							'<div class="col-md-3">'.	
									$customer->rcpnum.
								'</div>'.	

							'<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.	
									$customer->rcpdate.
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
