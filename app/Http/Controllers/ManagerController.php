<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\company;

use App\User;

use Spatie\Activitylog\Models\Activity;

class ManagerController extends Controller
{
    	public function edit($id){

           $data = company::find($id);
           
           
           $mdata = company::find($id)->manager;
           	//return dd($mdata);



           $User = User::all();
           //return dd($permission);
   

           return view('manager.manager_edit')
		   			->with('data',$data)
		   			->with('mdata',$mdata)
		   			->with('User',$User);
        }

        public function update(Request $request,$id){

			//return dd($request);

			$company = company::find($id);

			$user = User::all();


			foreach ($user as $data)  {

			if($request->has($data->id)){
				$company->manager()->detach($data->id);
				$company->manager()->attach($data->id);
				activity()
   					->performedOn($company)
   					->withProperties(['user_id' => $data->id])
   					->log('attach');	
			}
			else{
				$company->manager()->detach($data->id);
				//activity()->log('detach');
				//return dd("NNN");
			}
				
			}

			\Session::flash('flash_message', '新增成功!');

			return redirect()->action('CompanyController@view',$id);
			}
		
}
