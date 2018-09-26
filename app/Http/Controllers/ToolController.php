<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIswitch;

class ToolController extends Controller
{
    public function __construct(){
    	// 执行 auth 认证
   		$this->middleware('auth');
	}

	public function index(){

       $data = APIswitch::first();
		
		return view('tool.tool_index')
			->with('data',$data); 
	}	

	public function APIswitch(){

    $APIswitch = APIswitch::first();

       switch ($APIswitch->mode) {
       	case 'API':
       		$APIswitch->mode = 'Email';
       		$APIswitch->save();
       		break;
       	case 'Email':
       		$APIswitch->mode = 'Both';
       		$APIswitch->save();
       		break;
       	case 'Both':
       		$APIswitch->mode = 'API';
       		$APIswitch->save();
       		break;

       }

    $data = APIswitch::first();
	
		return view('tool.tool_index')
			->with('data',$data); 
	}
}
