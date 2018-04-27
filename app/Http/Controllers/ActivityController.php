<?php

namespace App\Http\Controllers;

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

use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function __construct(){
		    //Auth認證
    		$this->middleware('auth');	
	}

	public function index(){

		//$customers = Activity::all()
			   			  //->orderBy('id','desc')
			   			 // ;
                            //return dd($customers); 
	
		return view('activity.activity_all');
	}

    public function custome($id){

        //return dd($id);

        //$customers = Activity::all()
                          //->orderBy('id','desc')
                         // ;
                            //return dd($customers); 
        $activitycustome = $id;
            
        return view('activity.activity_custome')
                ->with('activitycustome',$activitycustome);
    }

    public function view($id){

        $data = Activity::find($id);

        $array = json_decode($data->properties,true);
        $old = null;
        $attributes = null;


        if($array){
            if(array_key_exists('old',$array)){
               $old = $array['old']; 
               //list($okey, $ovalue) = each($old);
            }
            if(array_key_exists('attributes',$array)){
                $attributes = $array['attributes'];
                //list($akey, $avalue) = each($attributes);
            }
        }

        //return dd($data,$array,$old,$attributes);

        return view('activity.activity_view')
            ->with('data',$data)
            ->with('old',$old)
            ->with('attributes',$attributes);
    }	


	public function activityload(Request $request){

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

    public function activitysearch(Request $request){

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

    public function activitycustome(Request $request){

        if($request->ajax())
        {
            $output="";

            //$customers=patch::all()->paginate(10);
            $customers = Activity::join('users','activity_log.causer_id','=','users.id')
                                    ->select('activity_log.*','users.name')
                                    ->where('subject_id','=',$request->activitycustome)
                                    ->orderBy('id','desc')
                                    ->get();
            //$customers = company::join('plan', 'company.com_plan_id','=', 'plan.id')
            //            ->join('users','company.com_builder_id','=','users.id')
            //            ->join('status','company.company_status','=','status.id')
            //            ->select('company.*','plan.plan_name','users.name','status.status_name')
            //            ->where('company_name','LIKE','%'.$request->companysearch.'%')
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
