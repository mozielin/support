<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\functions;

class FunctionController extends Controller
{
    
    public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}
	
	public function index(){
		   $function = functions::orderBy('id','desc')->paginate(5);
		
		   return view('function.function_all',['function' => $function]);
	}

	public function view($function_id){
           $function = functions::find($function_id);
           return view('function.function_view',['function' => $function]);
        }

	public function create(){
		   return view('function.function_create');
	}
	

	public function store(Request $request){

	//	$this->validate($request, [
    //		'function_name' => 'required|unique:functions|max:255',
	///	]);
			$validator = Validator::make($request->all(),[
				'function_name' => 'required|unique:function|max:45',
				'code' => 'required|unique:function',
				]);

			if ($validator->fails()){
				return redirect('function')
						->withErrors($validator)
						->withInput();
			}

			$function = new functions;
			$function -> function_name = $request->function_name;
			$function -> code = $request->code;
			$function -> select = $request->select;
			$function -> save();
			\Session::flash('flash_message', '新增成功!');
			return redirect()->action('FunctionController@index');
		}

			

	public function edit($function_id){
		$function = functions::find($function_id);
		return view('function.function_edit',['function' => $function]);
	}

	
	public function update(Request $request,$id){

		$validator = Validator::make($request->all(),[
				'function_name' => 'required|unique:function|max:45',
				'code' => 'required|unique:function',
				]);

			if ($validator->fails()){
				return redirect('function_edit')
						->withErrors($validator)
						->withInput();
			}

		$function = functions::find($id);
        $function -> function_name = $request->function_name;
        $function -> code = $request->code;
		$function -> select = $request->select;
        $function -> save();
        return redirect()->action('FunctionController@view',$id);


	}


	public function delete($id){

		functions::destroy($id);

		return redirect()->action('FunctionController@index');
        }


}
