<?php

use Illuminate\Database\Seeder;

use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('permissions')->delete();
        //DB::table('permissions')->truncate();
        Permission::create(['name' => 'user_view', 'display_name' => 'User_View','description' => '允許檢視User']);
        Permission::create(['name' => 'user_create', 'display_name' => 'User_Create','description' => '允許新增User']);
        Permission::create(['name' => 'user_edit', 'display_name' => 'User_Edit','description' => '允許修改User']);
        Permission::create(['name' => 'user_delete', 'display_name' => 'User_Delete','description' => '允許刪除User']);

        Permission::create(['name' => 'company_view', 'display_name' => 'Company_View','description' => '允許檢視Company']);
        Permission::create(['name' => 'company_create', 'display_name' => 'Company_Create','description' => '允許新增Company']);
        Permission::create(['name' => 'company_edit', 'display_name' => 'Company_Edit','description' => '允許修改Company']);
        Permission::create(['name' => 'company_delete', 'display_name' => 'Company_Delete','description' => '允許刪除Company']);

        Permission::create(['name' => 'contract_view', 'display_name' => 'Contract_View','description' => '允許檢視Contract']);
        Permission::create(['name' => 'contract_create', 'display_name' => 'Contract_Create','description' => '允許新增Contract']);
        Permission::create(['name' => 'contract_edit', 'display_name' => 'Contract_Edit','description' => '允許修改Contract']);
        Permission::create(['name' => 'contract_delete', 'display_name' => 'Contract_Delete','description' => '允許刪除Contract']);

        Permission::create(['name' => 'applicant_view', 'display_name' => 'Applicant_View','description' => '允許檢視Applicant']);
        Permission::create(['name' => 'applicant_create', 'display_name' => 'Applicant_Create','description' => '允許新增Applicant']);
        Permission::create(['name' => 'applicant_edit', 'display_name' => 'Applicant_Edit','description' => '允許修改Applicant']);
        Permission::create(['name' => 'applicant_delete', 'display_name' => 'Applicant_Delete','description' => '允許刪除Applicant']);

        Permission::create(['name' => 'server_view', 'display_name' => 'Server_View','description' => '允許檢視Server']);
        Permission::create(['name' => 'server_create', 'display_name' => 'Server_Create','description' => '允許新增Server']);
        Permission::create(['name' => 'server_edit', 'display_name' => 'Server_Edit','description' => '允許修改Server']);
        Permission::create(['name' => 'server_delete', 'display_name' => 'Server_Delete','description' => '允許刪除Server']);

        Permission::create(['name' => 'seadmin_view', 'display_name' => 'SE_View','description' => '允許檢視TLC']);
        Permission::create(['name' => 'seadmin_create', 'display_name' => 'SE_Create','description' => '允許新增TLC']);
        Permission::create(['name' => 'seadmin_edit', 'display_name' => 'SE_Edit','description' => '允許修改TLC']);
        Permission::create(['name' => 'seadmin_delete', 'display_name' => 'SE_Delete','description' => '允許刪除TLC']);

        Permission::create(['name' => 'license_view', 'display_name' => 'License_View','description' => '允許檢視License']);
        Permission::create(['name' => 'license_create', 'display_name' => 'License_Create','description' => '允許新增License']);
        Permission::create(['name' => 'license_edit', 'display_name' => 'License_Edit','description' => '允許修改License']);
        Permission::create(['name' => 'license_delete', 'display_name' => 'License_Delete','description' => '允許刪除License']);

        Permission::create(['name' => 'bulletin_view', 'display_name' => 'Bulletin_View','description' => '允許檢視Bulletin']);
        Permission::create(['name' => 'bulletin_create', 'display_name' => 'Bulletin_Create','description' => '允許新增Bulletin']);
        Permission::create(['name' => 'bulletin_edit', 'display_name' => 'Bulletin_Edit','description' => '允許修改Bulletin']);
        Permission::create(['name' => 'bulletin_delete', 'display_name' => 'Bulletin_Delete','description' => '允許刪除Bulletin']);

        Permission::create(['name' => 'interview_view', 'display_name' => 'Interview_View','description' => '允許檢視Interview']);
        Permission::create(['name' => 'interview_create', 'display_name' => 'Interview_Create','description' => '允許新增Interview']);
        Permission::create(['name' => 'interview_edit', 'display_name' => 'Interview_Edit','description' => '允許修改Interview']);
        Permission::create(['name' => 'interview_delete', 'display_name' => 'Interview_Delete','description' => '允許刪除Interview']);

        Permission::create(['name' => 'toolbox', 'display_name' => 'ToolBox','description' => '允許使用ToolBox']);
        Permission::create(['name' => 'unlimited', 'display_name' => 'Unlimited','description' => '查看不受相關人員限制']);

        Permission::create(['name' => 'receipt_view', 'display_name' => 'Receipt_View','description' => '允許檢視Receipt']);
        Permission::create(['name' => 'receipt_create', 'display_name' => 'Receipt_Create','description' => '允許新增Receipt']);
        Permission::create(['name' => 'receipt_edit', 'display_name' => 'Receipt_Edit','description' => '允許修改Receipt']);
        Permission::create(['name' => 'receipt_delete', 'display_name' => 'Receipt_Delete','description' => '允許刪除Receipt']);
    }
}
