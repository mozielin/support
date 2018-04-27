<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\role_user;
use App\Permission;


class RoleController extends Controller
{

	public function __construct(){
		    //Auth認證
    		$this->middleware('auth');
    		
		}

    public function index(){

		   $data = Role::orderBy('id','desc')->paginate(10);
		
		   return view('role.role_all')
		   			->with('data',$data);
	}

	public function view($id){

           $data = Role::find($id);
           $pdata = Role::find($id)->permissions;

           //return dd($pdata);

           return view('role.role_view')
		   			->with('data',$data)
		   			->with('pdata',$pdata);
        }

	public function create(){
		   return view('role.role_create');
	}
	

	public function store(Request $request){

			$role = new Role;
			$role -> name = $request->role_name;
			$role -> display_name = $request->display_name;
			$role -> description = $request->description;
			$role -> save();

			\Session::flash('flash_message', '新增成功!');

			return redirect()->action('RoleController@index');
		}

			

	public function edit($id){

           $data = Role::find($id);
           
           
           $pdata = Role::find($id)->permissions;


           $permission = Permission::all();
           //return dd($permission);
   

           return view('role.role_edit')
		   			->with('data',$data)
		   			->with('pdata',$pdata)
		   			->with('permission',$permission);
        }

	
	public function update(Request $request,$id){

			//return dd($request);
			$role = Role::find($id);
			$role -> name = $request->role_name;
			$role -> display_name = $request->display_name;
			$role -> description = $request->description;
			$role -> save();

			$permission = Permission::all();
			$permissionnum = Permission::all()->count();
			//return dd($permission);

			foreach ($permission as $data)  {

			if($request->has($data->id)){
				$role->detachPermission($data->id);
				$role->attachPermission($data->id);
			}
			else{
				$role->detachPermission($data->id);
				//return dd("NNN");
			}
				


			}

			\Session::flash('flash_message', '新增成功!');

			return redirect()->action('RoleController@index');
			}
		


	public function delete($id){

		//$role = Role::find($id);
		$role = Role::findOrFail($id);
		$permission = Permission::all();

		foreach ($permission as $data)  {

			$role->detachPermission($data->id);
			
		}

		Role::whereId($id)->delete();
		//return dd("NN");


		return redirect()->action('RoleController@index');
        }


}
