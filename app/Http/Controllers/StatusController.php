<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use View;
use App\status;


class StatusController extends Controller
{
     public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}


	public function index(){
		$status = status::orderBy('id','desc')->paginate(5);
		//傳遞title給視圖
                $title = '方案總攬';
                View::share('title', $title);
                
		return view('status.status_all',['status' => $status]);
	}

	public function view($status_id){
                $status = status::find($status_id);
                return view('status.status_view',['status' => $status]);
        }

	public function create(){
		return view('status.status_create');
	}


	public function store(Request $request){
		
		
	$validator = Validator::make($request->all(),[
			'status_name' => 'required|max:10',
			]);

	if ($validator->fails()){
		return redirect('status')
						->withErrors($validator)
						->withInput();
	}

	$status = new status;
	$status -> status_name = $request->status_name;
	$status -> status_class = $request->status_class;
	$status -> save();
	\Session::flash('flash_message', '新增成功!');
	return redirect()->action('StatusController@index');

	}

	public function edit($status_id){
		$status = status::find($status_id);
		return view('status.status_edit',['status' => $status]);
		
	}

	
	public function update(Request $request,$id){
		$status = status::find($id);
        $status -> status_name = $request->status_name;
        $status -> status_class = $request->status_class;
        $status -> save();
        return redirect()->action('StatusController@index');


	}


	public function delete($id){

		status::destroy($id);
		return redirect()->action('StatusController@index');
        }
}
