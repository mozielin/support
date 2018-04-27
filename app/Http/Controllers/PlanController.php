<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use View;
use App\plan;

class PlanController extends Controller
{
    
    public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}


	public function index(){
		$plan = plan::orderBy('id','desc')->paginate(5);
		//傳遞title給視圖
                $title = '方案總攬';
                View::share('title', $title);
		return view('company_plan.company_plan_all',['plan' => $plan]);
	}

	public function view($company_plan_id){
                $plan = plan::find($company_plan_id);
                return view('company_plan.company_plan_view',['plan' => $plan]);
        }

	public function create(){
		return view('company_plan.company_plan_create');
	}


	public function store(Request $request){
		
		
	$validator = Validator::make($request->all(),[
			'plan_name' => 'required|unique:plan|max:10',
			]);

	if ($validator->fails()){
		return redirect('plan')
						->withErrors($validator)
						->withInput();
	}

	$plan = new plan;
	$plan -> plan_name = $request->plan_name;
	$plan -> save();
	\Session::flash('flash_message', '新增成功!');
	return redirect()->action('PlanController@index');

	}

	public function edit($company_plan_id){
		$plan = plan::find($company_plan_id);
		return view('company_plan.company_plan_edit',['plan' => $plan]);
		
	}

	
	public function update(Request $request,$id){
		$plan = plan::find($id);
        $plan -> plan_name = $request->plan_name;
        $plan -> save();
        \Session::flash('flash_message', '新增成功!');
        return redirect()->action('PlanController@index');


	}


	public function delete($id){

		plan::destroy($id);
		return redirect()->action('PlanController@index');
        }

}
