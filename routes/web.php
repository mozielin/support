<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index')->name('home');


Route::get('/left', function(){
    return view('left');
});

//Route::get('/test', 'EmailController@index');
Route::get('/test','IndexController@test');


Route::get('/patch','VerController@index')->name('ver_index');
Route::get('/loadver','VerController@loadindex')->name('load_vindex');
Route::get('/patch/catch','VerController@dailycatch')->name('ver_catch');
Route::get('/patch/export','VerController@export')->name('ver_export');
Route::post('/patch/search','VerController@search')->name('ver_search');

Auth::routes();

Route::get('/home', 'IndexController@index')->name('home');

Route::group(['prefix'=>'company','middleware' => ['permission:company_view']], function(){

      Route::get('/', 'CompanyController@index')->name('company_index');

      Route::get('view/{company_id}', 'CompanyController@view')->name('company_view');

      Route::get('viewtrash/{company_id}', 'CompanyController@viewtrash')->name('company_viewtrash');

      Route::get('create',['middleware' => ['permission:company_create'], 'uses' => 'CompanyController@create'])->name('company_create');

      Route::post('store', 'CompanyController@store')->name('company_store');

      Route::get('restore/{company_id}', 'CompanyController@restore')->name('company_restore');

      Route::post('update/{company_id}', 'CompanyController@update')->name('company_update');

      Route::get('delete/{company_id}', 'CompanyController@delete')->name('company_delete');

      Route::name('company_export')->get('export','ExportController@export');

      Route::name('companysearch')->get('/companysearch','CompanyController@companysearch');

      Route::name('companytrash')->get('/companytrash','CompanyController@companytrash');

      Route::name('loadtrash')->get('/loadtrash','CompanyController@loadtrash');



      Route::name('companyload')->get('/loadcom','CompanyController@loadcom');

      Route::get('edit/{company_id}',['middleware' => ['permission:company_edit'], 'uses' =>'CompanyController@edit'])->name('company_edit');

      
});

Route::group(['prefix'=>'type','middleware' => ['role:admin|devenlope']], function(){

      Route::name('company_type_index')->get('/', 'TypeController@index');

      Route::get('view/{company_type_id}', 'TypeController@view')->name('company_type_view');

      Route::get('create', 'TypeController@create')->name('company_type_create');

      Route::post('store', 'TypeController@store')->name('company_type_store');

      Route::get('edit/{company_type_id}', 'TypeController@edit')->name('company_type_edit');

      Route::post('update/{id}', 'TypeController@update')->name('company_type_update');

      Route::get('delete/{company_type_id}', 'TypeController@delete')->name('company_type_delete');
});


Route::group(['prefix'=>'industry','middleware' => ['role:admin|devenlope']], function(){

      Route::get('/', 'IndustryController@index')->name('company_industry_index');

      Route::get('view/{company_industry_id}', 'IndustryController@view')->name('company_industry_view');

      Route::get('create', 'IndustryController@create')->name('company_industry_create');

      Route::post('store', 'IndustryController@store')->name('company_industry_store');

      Route::get('edit/{company_industry_id}', 'IndustryController@edit')->name('company_industry_edit');

      Route::post('update/{id}', 'IndustryController@update')->name('company_industry_update');

      Route::get('delete/{company_industry_id}', 'IndustryController@delete')->name('company_industry_delete');
});


Route::group(['prefix'=>'plan','middleware' => ['role:admin|devenlope']], function(){

      Route::get('/', 'PlanController@index')->name('company_plan_index');

      Route::get('view/{company_plan_id}', 'PlanController@view')->name('company_plan_view');

      Route::get('create', 'PlanController@create')->name('company_plan_create');

      Route::post('store', 'PlanController@store')->name('company_plan_store');

      Route::get('edit/{company_plan_id}', 'PlanController@edit')->name('company_plan_edit');

      Route::post('update/{id}', 'PlanController@update')->name('company_plan_update');

      Route::get('delete/{company_plan_id}', 'PlanController@delete')->name('company_plan_delete');
});

Route::group(['prefix'=>'status','middleware' => ['role:admin|devenlope']], function(){

      Route::get('/', 'StatusController@index')->name('status_index');

      Route::get('view/{status_id}', 'StatusController@view')->name('status_view');

      Route::get('create', 'StatusController@create')->name('status_create');

      Route::post('store', 'StatusController@store')->name('status_store');

      Route::get('edit/{status_id}', 'StatusController@edit')->name('status_edit');

      Route::post('update/{id}', 'StatusController@update')->name('status_update');

      Route::get('delete/{status_id}', 'StatusController@delete')->name('status_delete');
});

Route::group(['prefix'=>'area','middleware' => ['role:admin|devenlope']], function(){

      Route::name('company_area_index')->get('/', 'AreaController@index');

      Route::get('view/{company_area_id}', 'AreaController@view')->name('company_area_view');

      Route::get('create', 'AreaController@create')->name('company_area_create');

      Route::post('store', 'AreaController@store')->name('company_area_store');

      Route::get('edit/{company_type_id}', 'AreaController@edit')->name('company_area_edit');

      Route::post('update/{id}', 'AreaController@update')->name('company_area_update');

      Route::get('delete/{company_area_id}', 'AreaController@delete')->name('company_area_delete');
});


//若要驗證加入,'middleware' => ['role:Admin']
Route::group(['prefix'=>'user','middleware' => ['permission:user_view']], function(){

      Route::get('/', 'UserController@index')->name('user_index');

      Route::get('byid/{order}','UserController@byid')->name('user_byid');

      Route::get('byname/{order}','UserController@byname')->name('user_byname');

      Route::get('bygroup/{order}','UserController@bygroup')->name('user_bygroup');

      Route::get('byrole/{order}','UserController@byrole')->name('user_byrole');

      Route::get('bylogin/{order}','UserController@bylogin')->name('user_bylogin');

      Route::get('view/{user_id}', 'UserController@view')->name('user_view');

      Route::get('create',['middleware' => ['permission:user_create'], 'uses' => 'UserController@create'])->name('user_create');

      Route::post('store',['middleware' => ['permission:user_create'], 'uses' => 'UserController@store'])->name('user_store');

      Route::get('edit/{user_id}',['middleware' => ['permission:user_edit'], 'uses' => 'UserController@edit'])->name('user_edit');

      Route::post('update/{user_id}', ['middleware' => ['permission:user_edit'], 'uses' =>'UserController@update'])->name('user_update');

      Route::get('delete/{user_id}',['middleware' => ['permission:user_delete'], 'uses' => 'UserController@delete'])->name('user_delete');

      Route::name('user_upload')->post('/upload/{user_id}','UserController@upload');

      Route::name('user_reset')->get('resetpassword/{user_id}','UserController@reset');

      Route::name('user_resetpwd')->post('resetpwd/{user_id}','UserController@resetpwd');

});

Route::group(['prefix'=>'group','middleware' => ['role:admin|devenlope']], function(){

      Route::name('user_group_index')->get('/', 'GroupController@index');

      Route::get('view/{user_group_id}', 'GroupController@view')->name('user_group_view');

      Route::get('create', 'GroupController@create')->name('user_group_create');

      Route::post('store', 'GroupController@store')->name('user_group_store');

      Route::get('edit/{user_group_id}', 'GroupController@edit')->name('user_group_edit');

      Route::post('update/{id}', 'GroupController@update')->name('user_group_update');

      Route::get('delete/{user_group_id}', 'GroupController@delete')->name('user_group_delete');
});

Route::group(['prefix'=>'server','middleware' => ['permission:server_view']], function(){

      Route::name('server_index')->get('/', 'ServerController@index'); 

      Route::get('view/{server_id}', 'ServerController@view')->name('server_view');

      Route::get('create/',['middleware' => ['permission:server_create'], 'uses' => 'ServerController@create'])->name('server_create');

      Route::get('create_by/{id}', ['middleware' => ['permission:server_create'], 'uses' =>'ServerController@create_by'])->name('server_create_by');

      Route::post('store/', ['middleware' => ['permission:server_create'], 'uses' =>'ServerController@store'])->name('server_store');

      Route::get('edit/{server_id}', ['middleware' => ['permission:server_edit'], 'uses' =>'ServerController@edit'])->name('server_edit');

      Route::post('update/{id}',['middleware' => ['permission:server_edit'], 'uses' => 'ServerController@update'])->name('server_update');

      Route::get('delete/{server_id}',['middleware' => ['permission:server_delete'], 'uses' => 'ServerController@delete'])->name('server_delete');

      Route::name('serversearch')->get('/serversearch','ServerController@serversearch');

      Route::name('serverload')->get('/loadserver','ServerController@loadserver');

      Route::name('servercatch')->get('/servercatch',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@servercatch']);
});

Route::group(['prefix'=>'contract','middleware' => ['permission:contract_view']], function(){

      Route::name('contract_index')->get('/', 'ContractController@index');

      Route::name('contract_view')->get('/view/{id}','ContractController@view');

      Route::name('contract_show')->get('/show/{company_contract_picture}','ContractController@show');

      Route::name('contract_create')->get('create', ['middleware' => ['permission:contract_create'], 'uses' =>'ContractController@create']);

      Route::name('contract_create_by')->get('create_by/{id}',['middleware' => ['permission:contract_create'], 'uses' => 'ContractController@create_by']);

      Route::post('store',['middleware' => ['permission:contract_create'], 'uses' => 'ContractController@store'])->name('contract_store');

      Route::get('edit/{id}', ['middleware' => ['permission:contract_edit'], 'uses' =>'ContractController@edit'])->name('contract_edit');

      Route::post('upload', 'ContractController@upload')->name('contract_upload');

      Route::post('update/{id}', ['middleware' => ['permission:contract_edit'], 'uses' =>'ContractController@update'])->name('contract_update');

      Route::name('contract_delete')->get('/delete/{id}',['middleware' => ['permission:contract_delete'], 'uses' => 'ContractController@delete']);

      Route::name('contract_filedelete')->get('/filedelete/{id}','ContractController@filedelete');

      Route::name('contract_get')->post('get','ContractController@get'); 

      Route::name('contract_auto')->get('/contract_auto',array('as' =>'contract_auto','uses'=>'ContractController@contract_auto'));

      Route::name('contractsearch')->get('/contractsearch','ContractController@contractsearch');

      Route::name('contractload')->get('/loadcon','ContractController@loadcon');

      Route::name('contractalert')->post('/contractalert',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@contractalert']);

      Route::name('contractcheck')->get('/contractcheck',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@contractcheck']);
      

});
//live search 
Route::name('contract_gets')->get('/sindex','VerController@sindex');
Route::name('contract_123')->get('/dynamicsearch','VerController@dynamicsearch');
//autocomplete
//Route::get('/',array('as' =>'customer','uses'=>'VerController@kindex'));
Route::name('autocomplete')->get('/autocomplete',array('as' =>'autocomplete','uses'=>'VerController@autocomplete'));


Route::group(['prefix'=>'function','middleware' => ['role:admin|devenlope']], function(){

      Route::name('function_all')->get('/', 'FunctionController@index');

      Route::name('function_view')->get('/view/{id}','FunctionController@view'); 

      Route::name('function_store')->post('/store','FunctionController@store');

      Route::name('function_edit')->get('/edit/{id}','FunctionController@edit');

      Route::name('function_update')->post('update/{id}', 'FunctionController@update');

      Route::name('function_delete')->get('delete/{id}', 'FunctionController@delete');

});

Route::group(['prefix'=>'seadmin','middleware' => ['permission:seadmin_view']], function(){

      Route::name('seadmin_index')->get('/','SeController@index'); 

      Route::name('seadmin_loadindex')->get('/seadminload','SeController@loadindex');

      Route::name('seadmin_loadbytime')->get('/seadminloadbytime','SeController@loadbytime');

      Route::name('seadmin_search')->get('/seadminsearch','SeController@seadminsearch');

      Route::name('seadmin_create')->get('create',['middleware' => ['permission:seadmin_create'], 'uses' => 'SeController@create']);

      Route::name('seadmin_store')->post('store',['middleware' => ['permission:seadmin_create'], 'uses' => 'SeController@store']);

      Route::name('seadmin_edit')->get('edit/{id}',['middleware' => ['permission:seadmin_edit'], 'uses' => 'SeController@edit']);

      Route::name('seadmin_update')->post('update/{id}',['middleware' => ['permission:seadmin_edit'], 'uses' => 'SeController@update']);

      Route::name('seadmin_delete')->get('delete/{id}',['middleware' => ['permission:seadmin_delete'], 'uses' => 'SeController@delete']);   

      //Route::name('seadmin_tlc')->get('/seadmin_tlc',array('as' =>'seadmin_tlc','uses'=>'SeController@seadmin_tlc'));
      Route::name('seadmin_tlc')->get('/seadmin_tlc','SeController@seadmin_tlc');

      Route::name('tlcalert')->post('/tlcalert',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@tlcalert']);

      Route::name('tlccheck')->get('/tlccheck',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@tlccheck']);

      Route::name('tlcchecknow')->get('/tlcchecknow',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@tlcchecknow']);

      Route::name('seadmin_lic')->post('/licscan','SeController@licscan'); 

      Route::name('seadmin_uploadlic')->get('/uploadlic','SeController@uploadlic');

      Route::name('seadmin_cancel')->get('/cancellic/{filepath}','SeController@cancellic');
      
      });


Route::group(['prefix'=>'applicant','middleware' => ['permission:applicant_view']], function(){

      Route::name('applicant_index')->get('/', 'ApplicantController@index');

      Route::name('applicant_vip')->get('/vip', 'ApplicantController@vip');

      Route::name('applicant_view')->get('/view/{id}','ApplicantController@view');

      Route::name('applicant_views')->get('/views/{id}','ApplicantController@views');

      Route::name('applicant_show')->get('/show/{company_applicant_picture}','ApplicantController@show');

      Route::name('applicant_create')->get('create',['middleware' => ['permission:applicant_create'], 'uses' => 'ApplicantController@create']);

      Route::name('applicant_create_by')->get('create_by/{id}', ['middleware' => ['permission:applicant_create'], 'uses' =>'ApplicantController@create_by']);

      Route::post('store',['middleware' => ['permission:applicant_create'], 'uses' => 'ApplicantController@store'])->name('applicant_store');

      Route::get('edit/{id}', ['middleware' => ['permission:applicant_edit'], 'uses' =>'ApplicantController@edit'])->name('applicant_edit');

      Route::post('upload', 'ApplicantController@upload')->name('applicant_upload');

      Route::post('update/{id}', ['middleware' => ['permission:applicant_edit'], 'uses' =>'ApplicantController@update'])->name('applicant_update');

      Route::name('applicant_delete')->get('/delete/{id}', 'ApplicantController@delete');

      Route::name('applicant_filedelete')->get('/filedelete/{id}','ApplicantController@filedelete');

      Route::name('applicant_get')->post('get','ApplicantController@get'); 

      Route::name('applicant_auto')->get('/applicant_auto',array('as' =>'applicant_auto','uses'=>'ApplicantController@applicant_auto'));

      Route::name('applicantsearch')->get('/applicantsearch','ApplicantController@applicantsearch');

      Route::name('loadapplicant')->get('/loadapplicant','ApplicantController@loadapplicant');

});

Route::group(['prefix'=>'role','middleware' => ['role:admin|devenlope']], function(){ 

      Route::name('role_index')->get('/', 'RoleController@index');

      Route::get('view/{role_id}', 'RoleController@view')->name('role_view');

      Route::get('create', 'RoleController@create')->name('role_create');

      Route::post('store', 'RoleController@store')->name('role_store');

      Route::get('edit/{role_id}', 'RoleController@edit')->name('role_edit');

      Route::post('/update/{id}', 'RoleController@update')->name('role_update');

      Route::get('delete/{role_id}', 'RoleController@delete')->name('role_delete');
});

Route::group(['prefix'=>'permission','middleware' => ['role:admin|devenlope']], function(){

      Route::name('permission_index')->get('/', 'PermissionController@index');

      Route::get('view/{permission_id}', 'PermissionController@view')->name('permission_view');

      Route::get('create', 'PermissionController@create')->name('permission_create');

      Route::post('store', 'PermissionController@store')->name('permission_store');

      Route::get('edit/{permission_id}', 'PermissionController@edit')->name('permission_edit');

      Route::post('/update/{id}', 'PermissionController@update')->name('permission_update');

      Route::get('delete/{permission_id}', 'PermissionController@delete')->name('permission_delete');
});

Route::group(['prefix'=>'license','middleware' => ['permission:license_view']], function(){

      Route::name('license_index')->get('/', 'LicController@index');

      //Route::name('license_test')->get('/test', 'LicController@test');

      Route::name('license_view')->get('/view/{id}','LicController@view');

      //Route::name('license_show')->get('/show/{lic_picture}','LicController@show');

      Route::name('license_create')->get('create', ['middleware' => ['permission:license_create'], 'uses' =>'LicController@create']);

      Route::name('license_create_test')->get('create_test',['middleware' => ['permission:license_create'], 'uses' => 'LicController@create_test']);

      Route::name('upload_by')->get('upload_by/{id}', ['middleware' => ['permission:license_create'], 'uses' =>'LicController@upload_by']);

      Route::post('store',['middleware' => ['permission:license_create'], 'uses' => 'LicController@store'])->name('license_store');

      Route::get('edit/{id}',['middleware' => ['permission:license_edit'], 'uses' => 'LicController@edit'])->name('license_edit');

      Route::post('upload',['middleware' => ['permission:license_edit'], 'uses' => 'LicController@upload'])->name('license_upload');

      Route::post('upload_store', ['middleware' => ['permission:license_edit'], 'uses' =>'LicController@upload_store'])->name('upload_store');

      Route::get('upload_by/{id}', ['middleware' => ['permission:license_edit'], 'uses' =>'LicController@upload_by'])->name('upload_by');

      Route::post('upload_create', ['middleware' => ['permission:license_edit'], 'uses' =>'LicController@upload_create'])->name('upload_create');

      Route::post('update/{id}', ['middleware' => ['permission:license_edit'], 'uses' =>'LicController@update'])->name('license_update');

      Route::get('cancel/{company_id}/{filepath}', 'LicController@cancel')->name('license_cancel');

      Route::name('license_delete')->get('/delete/{id}',['middleware' => ['permission:license_delete'], 'uses' => 'LicController@delete']);

      Route::name('license_filedelete')->get('/filedelete/{id}',['middleware' => ['permission:license_delete'], 'uses' =>'LicController@filedelete']);

      Route::name('license_get')->post('get','LicController@get'); 

      Route::name('license_auto')->get('/license_auto',array('as' =>'license_auto','uses'=>'LicController@license_auto'));

      Route::name('licensealert')->get('/licensealert',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@licensealert']);

      Route::name('licensecheck')->get('/licensecheck',['middleware' => ['role:admin|devenlope'], 'uses' =>'ScheduleController@licensecheck']);

      Route::name('licsearch')->get('/licsearch','LicController@licsearch');

      Route::name('loadlic')->get('/loadlic','LicController@loadlic');
});

Route::group(['prefix'=>'bulletin','middleware' => ['permission:bulletin_view']], function(){

      Route::name('bulletin_index')->get('/','BulletinController@index'); 

      Route::name('bulletin_loadindex')->get('/bulletinload','BulletinController@loadindex');

      Route::name('bulletin_loadbytime')->get('/bulletinloadbytime','BulletinController@loadbytime');

      Route::name('bulletin_view')->get('/view/{id}','BulletinController@view');

      Route::name('bulletin_search')->get('/bulletinsearch','BulletinController@bulletinsearch');

      Route::name('bulletin_create')->get('create', ['middleware' => ['permission:bulletin_create'], 'uses' =>'BulletinController@create']);

      Route::name('bulletin_store')->post('store',['middleware' => ['permission:bulletin_create'], 'uses' => 'BulletinController@store']);

      Route::name('bulletin_edit')->get('edit/{id}', ['middleware' => ['permission:bulletin_edit'], 'uses' =>'BulletinController@edit']);

      Route::name('bulletin_update')->post('update/{id}', ['middleware' => ['permission:bulletin_edit'], 'uses' =>'BulletinController@update']);

      Route::name('bulletin_delete')->get('delete/{id}', ['middleware' => ['permission:bulletin_delete'], 'uses' =>'BulletinController@delete']);   
});

Route::group(['prefix'=>'manager','middleware' => ['permission:company_view']], function(){

      Route::name('manager_edit')->get('edit/{id}', ['middleware' => ['permission:company_edit'], 'uses' =>'ManagerController@edit']);

      Route::name('manager_update')->post('update/{id}', ['middleware' => ['permission:company_edit'], 'uses' =>'ManagerController@update']);

      Route::name('manager_delete')->get('delete/{id}',['middleware' => ['permission:company_delete'], 'uses' => 'ManagerController@delete']);   
});

Route::group(['prefix'=>'activity','middleware' => ['role:admin|devenlope']], function(){

      Route::name('activity_index')->get('/', 'ActivityController@index');

      Route::name('activity_view')->get('view/{id}', 'ActivityController@view');

      Route::name('activity_custome')->get('/activitysearch/{id}', 'ActivityController@custome');

      Route::name('activityload')->get('/activityload','ActivityController@activityload');

      Route::name('activitysearch')->get('/activitysearch','ActivityController@activitysearch');

      Route::name('activitycustome')->get('/activitycustome','ActivityController@activitycustome');

});

Route::group(['prefix'=>'filemanage','middleware' => ['role:admin|devenlope']], function(){

      Route::name('filemanage_all')->get('/', 'FileManageController@index');

});


Route::group(['prefix'=>'export','middleware' => ['role:admin|devenlope']], function(){

      Route::name('export_all')->get('/', 'ExportController@index');

      Route::name('letter')->get('/letter', 'LetterController@letter');

      Route::name('export_total')->get('/total', 'ExportController@total');

      Route::name('upload_cloud')->post('/upload_cloud','ExportController@upload_cloud');

      Route::name('download_total')->get('/download_total', 'ExportController@download_total');

      Route::name('export_k')->post('/export_k', 'ExportController@export_k');

});

Route::group(['prefix'=>'tool','middleware' => ['permission:toolbox']], function(){

      Route::name('tool_index')->get('/', 'ToolController@index');

      Route::name('APIswitch')->get('/APIswitch',['middleware' => ['role:admin|devenlope'], 'uses' =>  'ToolController@APIswitch']);
  

});

Route::group(['prefix'=>'interview','middleware' => ['permission:interview_view']], function(){

      Route::name('interview_index')->get('/', 'InterviewController@index');

      Route::name('interview_create')->get('/create/{id}', 'InterviewController@create');

      Route::name('interview_view')->get('view/{id}', 'InterviewController@view');

      Route::post('/store', ['middleware' => ['permission:interview_view'], 'uses' =>'InterviewController@store'])->name('interview_store');

      Route::name('interview_delete')->get('/delete/{id}',['middleware' => ['permission:interview_delete'], 'uses' => 'InterviewController@delete']);

      Route::name('interview_custome')->get('/interviewsearch/{id}', 'InterviewController@custome');

      Route::name('interviewload')->get('/interviewload','InterviewController@interviewload');

      Route::name('interviewsearch')->get('/interviewsearch','InterviewController@interviewsearch');

      Route::name('interviewcustome')->get('/interviewcustome','InterviewController@interviewcustome');

});

Route::group(['prefix'=>'version','middleware' => ['role:admin|devenlope']], function(){

      Route::name('version_index')->get('/', 'VerController@index');

      Route::get('view/{version_id}', 'VerController@view')->name('version_view');

      Route::get('create', 'VerController@create')->name('version_create');

      Route::post('store', 'VerController@store')->name('version_store');

      Route::get('edit/{version_id}', 'VerController@edit')->name('version_edit');

      Route::post('update/{id}', 'VerController@update')->name('version_update');

      Route::get('delete/{version_id}', 'VerController@delete')->name('version_delete');
});

