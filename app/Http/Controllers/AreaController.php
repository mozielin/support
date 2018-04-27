<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\company_area;

class AreaController extends Controller
{
     public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){
		   $area = company_area::orderBy('id','desc')->paginate(5);
		
		   return view('company_area.company_area_all',['area' => $area]);
	}

	public function view($company_area_id){
           $area = company_area::find($company_area_id);
           return view('company_area.company_area_view',['area' => $area]);
        }

	public function create(){
		   return view('company_area.company_area_create');
	}
	

	public function store(Request $request){

	//	$this->validate($request, [
    //		'company_area_name' => 'required|unique:company_areas|max:255',
	///	]);
			$validator = Validator::make($request->all(),[
				'area_name' => 'required|unique:company_area|max:40',
				]);

			if ($validator->fails()){
				return redirect('area')
						->withErrors($validator)
						->withInput();
			}

			$area = new company_area;
			$area -> area_name = $request->area_name;
			$area -> save();
			\Session::flash('flash_message', '新增成功!');
			return redirect()->action('AreaController@index');
		}

			

	public function edit($company_area_id){
		$area = company_area::lockForUpdate()->find($company_area_id);
		return view('company_area.company_area_edit',['area' => $area]);
	}

	
	public function update(Request $request,$id){
		$area = company_area::find($id);
        $area -> area_name = $request->area_name;
        $area -> save();
        return redirect()->action('AreaController@index');


	}


	public function delete($id){

		company_area::destroy($id);

		return redirect()->action('AreaController@index');
        }

}
