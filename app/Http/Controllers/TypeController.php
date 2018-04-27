<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\company_type;

class TypeController extends Controller
{
    
    public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){
		   $type = company_type::orderBy('id','desc')->paginate(5);
		
		   return view('company_type.company_type_all',['type' => $type]);
	}

	public function view($company_type_id){
           $type = company_type::find($company_type_id);
           return view('company_type.company_type_view',['type' => $type]);
        }

	public function create(){
		   return view('company_type.company_type_create');
	}
	

	public function store(Request $request){

	//	$this->validate($request, [
    //		'company_type_name' => 'required|unique:company_types|max:255',
	///	]);
			$validator = Validator::make($request->all(),[
				'company_type_name' => 'required|unique:company_types|max:10',
				]);

			if ($validator->fails()){
				return redirect('type')
						->withErrors($validator)
						->withInput();
			}

			$type = new company_type;
			$type -> company_type_name = $request->company_type_name;
			$type -> save();
			\Session::flash('flash_message', '新增成功!');
			return redirect()->action('TypeController@index');
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

		company_type::destroy($id);

		return redirect()->action('TypeController@index');
        }


}
