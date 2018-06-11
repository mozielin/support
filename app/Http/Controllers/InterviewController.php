<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\interview;

use App\company;

class InterviewController extends Controller
{
    public function __construct(){
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){
		 
		   return view('interview.interview_all');
	}

	public function view($id){
           $interview = interview::join('company','interview.company_id','=','company.id')->where('interview.id','=',$id)->select('interview.*','company.company_name')->first();
           //return dd($interview);

           return view('interview.interview_views',['data' => $interview]);
        }

	public function create($id){

		$company = company::find($id);
		   return view('interview.interview_create_by',['company' => $company]);
	}
	

	public function store(Request $request){

		//return dd($request);

			$interview = new interview;
			$interview -> note = $request->note;
			$interview -> todo = $request->todo;
			$interview -> company_id = $request->company_id;
			$interview -> builder = $request->builder;
			$interview -> text = $request->text;

			$interview -> save();
			\Session::flash('flash_message', '新增成功!');
			return redirect()->action('CompanyController@view',$request->company_id);
		}

			

	public function edit($company_type_id){
		$type = company_type::lockForUpdate()->find($company_type_id);
		return view('company_type.company_type_edit',['type' => $type]);
	}

	
	public function update(Request $request,$id){
		$type = company_type::find($id);
        $type -> company_type_name = $request->name;
        $type -> save();
        return redirect()->action('TypeController@index');


	}


	public function delete($id){

		$interview = interview::find($id);

		$back = $interview->company_id;

		interview::destroy($id);

		return redirect()->action('CompanyController@view',$back);
        }

    public function interviewload(Request $request){

    	if($request->ajax())
        {
            $output="";

            
            //原始資料
           // $customers = Activity::orderBy('id','desc')->get();

            //需要使用者名稱時可用以下p.s欄位記得也要改
            $customers = Activity::join('users','activity_log.causer_id','=','users.id')->orderBy('activity_log.id','desc')->select('activity_log.*','users.name')->take(1000)->get();

                            //return dd($customers);           
                                  
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../activity/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->log_name.
                                '</div>'.
                            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->subject_id.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->description.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->name.
                            '</div>'.

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->created_at.
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

    public function interviewsearch(Request $request){

    	if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);
            $customers = Activity::join('users','activity_log.causer_id','=','users.id')
                                ->select('activity_log.*','users.name')
                                ->where('subject_id','=',$request->activitysearch)
			   			        ->orderBy('id','desc')
                                ->take(1000)
			   			        ->get();
            //$customers = company::join('plan', 'company.com_plan_id','=', 'plan.id')
		   	//			  ->join('users','company.com_builder_id','=','users.id')
		   	//			  ->join('status','company.company_status','=','status.id')
		   	//			  ->select('company.*','plan.plan_name','users.name','status.status_name')
		   	//			  ->where('company_name','LIKE','%'.$request->companysearch.'%')
              //  ->orWhere('company_EIN','LIKE','%'.$request->companysearch.'%')
                //->orWhere('company_engname','LIKE','%'.$request->companysearch.'%')
                //->get();
                          //  return dd($customers);                 
            if($customers)
            {
                foreach($customers as $key => $customer)
                {
                    $output.=

                    '<div class= " panel panel-default test " style="cursor:pointer; width:100%;"'.'onclick="location.href=\'../activity/view/'.$customer->id.'\' ">'.

                        '<div class="panel-heading " style="height:100%;">'.                
                            '<div class="row" style="text-align:center;">'.

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                 $customer->log_name.
                                '</div>'.
                            
                            '<div class="col-md-3" style="border-right:1px solid black;">'. 
                                $customer->subject_id.
                                '</div>'.   

                            '<div class="col-md-2">'.   
                                    $customer->description.
                                '</div>'.   

                            '<div class="col-md-2" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->name.
                            '</div>'.

                            '<div class="col-md-3" style="border-right:1px solid black; border-left:1px solid black;">'.    
                                    $customer->created_at.
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
