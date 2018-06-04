<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use Entrust;
use App\User;
use View;
use App\Role;
use App\role_user;
use Carbon\Carbon;
use App\group;

class UserController extends Controller
{

	public function __construct()
	{
    // 执行 auth 认证
    $this->middleware('auth');
	}

    public function index(){
		//$data = User::orderBy('id','desc')->paginate(5);
        //$data = User::with('roles')->paginate(10);

        $data = User::join('user_group','users.user_group','=','user_group.id')
                    ->join('role_user','users.id','=','role_user.user_id')
                    ->join('roles','role_user.role_id','=','roles.id')
                    ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
                    ->orderBy('id','desc')
                    ->paginate(10);
       
        //return dd($data);
        //$user_group = group::all();

        //\Session::put('user',Auth::user());
        //$group = group::where('id','=',Auth::user()->user_group)->first();
        //$Sgroup = $group->user_group_name;
        //\Session::put('group', $Sgroup);

        $count = User::count();
        
        $order = 0;
	return view('user.user_all')
                ->with('data',$data)
                ->with('order',$order)
                ->with('count',$count);
                //->with('user_group',$user_group); 
	}	

 	public function create(){

        $user_role = Role::all();
        $group = group::all();
		
	return view('user.user_create')
                ->with('group',$group)
                ->with('user_role',$user_role);
	}	

	public function view($user_id){
                    //驗證查詢userID是否為登入ID||是否有權限查看
        if (Auth::user()->id == $user_id || Entrust::hasRole('admin') || Entrust::hasRole('devenlope')) {
                 
        $user = User::join('user_group','users.user_group','=','user_group.id')
              ->join('role_user','users.id','=','role_user.user_id')
              ->join('roles','role_user.role_id','=','roles.id')
              ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
              ->find($user_id);

        if($user->user_img == '0'){
                       //找到使用者圖片路徑
            $url = Storage::url("user_img/user_default.png");
                    //儲存路徑給view
            $img = "$url";  
        }
        else{
             //找到使用者圖片路徑
            $url = Storage::url("user_img/$user->user_img");
                        //儲存路徑給view
            $img = "$url"; 

        }
            
        return view('user.user_view')
             ->with('user',$user)
             ->with('img',$img);
            }
        \Session::flash('flash_message', '權限不足!');
            return view('denied');
    }



    protected function store(Request $request)
    {    	

    	$validator = Validator::make($request->all(),[
				'name' => 'required|string|max:255',
            	'email' => 'required|string|email|max:255|unique:users',
            	'user_group' => 'required|string|max:10',
            	'password' => 'required|string|min:6|confirmed',
				]);

			if ($validator->fails()){
				return redirect('user/create')
						->withErrors($validator)
						->withInput();
			}
            //儲存USER
			$data = new User;
			$data -> name = $request->name;
			$data -> email = $request->email;
			$data -> user_group = $request->user_group;
			$data -> password = bcrypt($request->password);
			$data -> save();
            $data->attachRole($request->user_role);
            
            //儲存使用者至角色表
            //$role = new role_user;
            //-----------取得剛新增的使用者ID
            //$role -> user_id = $data -> id;
            //$role -> role_id = $request -> user_role;
            //$role -> save();



			return redirect()->action('UserController@index');
        
       
    }
	

	public function edit($user_id){
        //驗證查詢userID是否為登入ID||是否有權限查看
        if (Auth::user()->id == $user_id || Entrust::hasRole('admin') || Entrust::hasRole('devenlope')) {
                 
        $user = User::join('user_group','users.user_group','=','user_group.id')
              ->join('role_user','users.id','=','role_user.user_id')
              ->join('roles','role_user.role_id','=','roles.id')
              ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
              ->find($user_id);

                    //找到使用者圖片路徑
        $url = Storage::url("user_img/$user->user_img");
                    //儲存路徑給view
        $img = "$url"; 
                    //傳遞title給視圖
                    //$title = '使用者資料';
                    //View::share('rolename', $rolename);

        $data = Role::all();
        $user_role = User::with('roles')->where('id',$user_id)->get();

        $user_group = group::all();
        return view('user.user_edit')
             ->with('user',$user)
             ->with('img',$img)
             ->with('data',$data)
            ->with('user_role',$user_role)
            ->with('user_group',$user_group);
            }
        \Session::flash('flash_message', '權限不足!');
            return view('denied');

		//$user = user::find($user_id);
        
       // $data = Role::all();
        //$user_role = User::with('roles')->where('id',$user_id)->get();

        //$user_group = group::all();

        //return dd($user_role->roles->id);
		//return view('user.user_edit')
        //->with('user',$user)
        //->with('data',$data)
        //->with('user_role',$user_role)
        //->with('user_group',$user_group);
	}

	public function upload(Request $request,$id)
    {       
        
        
        if ($request->file('image')){
        	//取得上傳原始名稱
            $filename = $request->image->getClientOriginalName();
            //儲存圖片名稱(USER_ID+原始檔名)
            $user_img = "$id$filename";
            //$request->image->storeAs('public/user_img',"$user_img");
            $request->file('image')->storeAs('public/user_img',"$user_img");                  
            //儲存檔案名稱>資料庫
            $user = user::find($id);
            //取出舊的圖片名
            $olduser_img = $user -> user_img;

            //刪除舊圖片
            Storage::delete("/public/user_img/$olduser_img");
            //儲存新圖片名稱
        	$user -> user_img = $user_img;       
        	$user -> save();

            return redirect()->action('UserController@view',$user->id);
        }else{
            return 'No file';
        }       
    }

    /*圖片顯示
    public function show($data){
        //return Storage::allFiles('public');
        $url = Storage::url($data);
        return "<image src='".$url."'/>";
    }
    */


	
	public function update(Request $request,$id){
		$user = User::find($id);
        $user -> name = $request->name;
        $user -> email = $request->email;
        if($request->title){
            $user-> title = $request->title;
        }
        if($request->phone){
            $user-> phone = $request->phone;
        }
        if($request->ext){
            $user-> ext = $request->ext;
        }
        if($request->mobile){
            $user-> mobile = $request->mobile;
        }

        if(Entrust::hasRole('admin') or Entrust::hasRole('devenlope')){

        $user -> user_group = $request->user_group;       
        //先刪除舊Role關聯
        $user -> detachRoles($user -> roles);
        //再新增role角色
        $user -> attachRole($request -> user_role);
        }
        
              
        $user -> save();

       
        //儲存使用者至角色表(笨方法)
        //$role = role_user::where('user_id','=',$id)
        //        ->update(['role_id' => $request->user_role]);
        //-----------取得剛新增的使用者ID
        
        return redirect()->action('UserController@view',$user->id);


	}

    public function reset($id){
        $user = user::find($id);
        return view('user.user_reset')
                ->with('user',$user);
    }

    public function resetpwd(Request $request,$id){
        $user = user::find($id);
        $user -> password = bcrypt($request->password);
        $user -> save();
        return redirect()->action('UserController@view',$user->id);
    }


	public function delete($id){

		user::destroy($id);
		return redirect()->action('UserController@index');
        }

    public function byid($order){
        
        if ($order == 0) {
            $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('id','desc')
            ->paginate(10);        	
            $order = 1;
        }
        else{

          $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('id','asc')
            ->paginate(10);        	
            $order = 0;}          
                    
                    
	return view('user.user_all')
                ->with('data',$data)
                ->with('order',$order);
	}	

    public function byname($order){
        
        if ($order == 0) {
            $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('name','desc')
            ->paginate(10);        	
            $order = 1;
        }
        else{

          $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('name','asc')
            ->paginate(10);        	
            $order = 0;}          
                    
                    
	return view('user.user_all')
                ->with('data',$data)
                ->with('order',$order);
	}	

	public function bygroup($order){
        if ($order == 0) {
            $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('user_group_name','desc')
            ->paginate(10);        	
            $order = 1;
        }
        else{

          $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('user_group_name','asc')
            ->paginate(10);        	
            $order = 0;}          
                    
                    
	return view('user.user_all')
                ->with('data',$data)
                ->with('order',$order);
	}	

	public function byrole($order){
        if ($order == 0) {
            $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('display_name','desc')
            ->paginate(10);        	
            $order = 1;
        }
        else{

          $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('display_name','asc')
            ->paginate(10);        	
            $order = 0;}          
                    
                    
	return view('user.user_all')
                ->with('data',$data)
                ->with('order',$order);
	}	

	public function bylogin($order){
        if ($order == 0) {
            $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('login_at','desc')
            ->paginate(10);        	
            $order = 1;
        }
        else{

          $data = User::join('user_group','users.user_group','=','user_group.id')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.*','user_group.user_group_name','role_user.*', 'roles.display_name')
	        ->orderBy('login_at','asc')
            ->paginate(10);        	
            $order = 0;}          
                    
                    
	return view('user.user_all')
                ->with('data',$data)
                ->with('order',$order); 
	}

}
