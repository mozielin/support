<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\group;

class GroupController extends Controller
{
public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){
		   $data = group::orderBy('id','desc')->paginate(10);
		
		   return view('user_group.user_group_all',['data' => $data]);
	}

	public function view($group_id){
           $group = group::find($group_id);
           return view('user_group.user_group_view',['group' => $group]);
        }

	public function create(){
		   return view('user_group.user_group_create');
	}
	

	public function store(Request $request){

	//	$this->validate($request, [
    //		'group_name' => 'required|unique:groups|max:255',
	///	]);
			$validator = Validator::make($request->all(),[
				'user_group_name' => 'required|unique:user_group|max:10',
				]);

			if ($validator->fails()){
				return redirect('group')
						->withErrors($validator)
						->withInput();
			}

			$group = new group;
			$group -> user_group_name = $request->user_group_name;
			$group -> save();
			\Session::flash('flash_message', '新增成功!');
			return redirect()->action('GroupController@index');
		}

			

	public function edit($group_id){
		$group = group::find($group_id);
		return view('user_group.user_group_edit',['group' => $group]);
	}

	
	public function update(Request $request,$id){
		$group = group::find($id);
        $group -> user_group_name = $request->user_group_name;
        $group -> save();
        return redirect()->action('GroupController@index');


	}


	public function delete($id){

		group::destroy($id);

		return redirect()->action('GroupController@index');
        }


}
