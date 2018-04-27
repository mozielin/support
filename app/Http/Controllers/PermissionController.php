<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\role_user;
use App\Permission;

class PermissionController extends Controller
{
    
	public function __construct(){
		    //Auth認證
    		$this->middleware('auth');
    		
		}

    public function index(){

		   $data = Permission::orderBy('id','desc')->paginate(10);
		
		   return view('permission.permission_all')
		   			->with('data',$data);
	}

	public function view($id){

           $data = Permission::find($id);
           $pdata = Permission::find($id)->roles;

           //return dd($pdata);

           return view('permission.permission_view')
		   			->with('data',$data)
		   			->with('pdata',$pdata);
        }

	public function create(){
		   return view('permission.permission_create');
	}
	

	public function store(Request $request){

			$permission = new Permission;
			$permission -> name = $request->permission_name;
			$permission -> display_name = $request->display_name;
			$permission -> description = $request->description;
			$permission -> save();

			\Session::flash('flash_message', '新增成功!');

			return redirect()->action('PermissionController@index');
		}

			

	public function edit($id){

           $data = Permission::find($id);
           $pdata = Permission::find($id)->roles;

           //return dd($pdata);

           return view('permission.permission_edit')
		   			->with('data',$data)
		   			->with('pdata',$pdata);
        }

	
	public function update(Request $request,$id){
		
			$permission = Permission::find($id);
        
			$permission -> name = $request->permission_name;
			$permission -> display_name = $request->display_name;
			$permission -> description = $request->description;
			$permission -> save();

			\Session::flash('flash_message', '新增成功!');

			return redirect()->action('PermissionController@index');
		}


	public function delete($id){

		Permission::destroy($id);

		return redirect()->action('PermissionController@index');
        }
}
