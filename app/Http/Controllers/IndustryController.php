<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\company_industry;

class IndustryController extends Controller
{
    
    public function __construct()
		{
    	// 执行 auth 认证
    	$this->middleware('auth');
		}

    public function index(){
		$industry = company_industry::orderBy('id','desc')->paginate(5);
		
		return view('company_industry.company_industry_all',['industry' => $industry]);
	}

	 public function view($company_industry_id){
                $industry = company_industry::find($company_industry_id);
                return view('company_industry.company_industry_view',['industry' => $industry]);
        }

	public function create(){
		return view('company_industry.company_industry_create');
	}
	
	protected function validator(array $data)
        {
       	    return Validator::make($data, [
            
            'email' => 'required|string|email|max:255|unique:users',
            
        ]);
        }

	


	public function store(Request $request){


	$validator = Validator::make($request->all(),[
			'company_industry_name' => 'required|unique:company_industry|max:10',
			]);

	if ($validator->fails()){
		return redirect('industry')
						->withErrors($validator)
						->withInput();
	}

	$industry = new company_industry;
	$industry -> company_industry_name = $request->company_industry_name;
	$industry -> save();
	\Session::flash('flash_message', '新增成功!');
	return redirect()->action('IndustryController@index');

	}

	public function edit($company_industry_id){
		$industry = company_industry::find($company_industry_id);
		return view('company_industry.company_industry_edit',['industry' => $industry]);
	}

	
	public function update(Request $request,$id){
	$industry = company_industry::find($id);
        $industry -> company_industry_name = $request->name;
        $industry -> save();
        \Session::flash('flash_message', '更新成功!');
        return redirect()->action('IndustryController@index');


	}


	public function delete($id){

		company_industry::destroy($id);
		return redirect()->action('IndustryController@index');
        }

}
