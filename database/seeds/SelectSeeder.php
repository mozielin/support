<?php

use Illuminate\Database\Seeder;

use App\group;
use App\company_industry;
use App\company_type;
use App\plan;



class SelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        group::create(['user_group_name' => '管理者']);
        group::create(['user_group_name' => '新用戶']);
        group::create(['user_group_name' => '客服']);
        group::create(['user_group_name' => 'SE']);
        group::create(['user_group_name' => '業務']);
        group::create(['user_group_name' => 'PM']);
        group::create(['user_group_name' => '行銷']);
        group::create(['user_group_name' => '財務']);

        company_industry::create(['company_industry_name' => '農、林、牧、漁業']);
        company_industry::create(['company_industry_name' => '宗教組織']);
        company_industry::create(['company_industry_name' => '製造業']);
        company_industry::create(['company_industry_name' => '電力、然氣及水的生產和供應業']);
        company_industry::create(['company_industry_name' => '建築業']);
        company_industry::create(['company_industry_name' => '交通運輸、倉儲和郵政業']);
        company_industry::create(['company_industry_name' => '資訊傳輸、電腦服務和軟體業']);
        company_industry::create(['company_industry_name' => '批發和零售業']);
        company_industry::create(['company_industry_name' => '住宿和餐飲業']);
        company_industry::create(['company_industry_name' => '金融、保險業']);
        company_industry::create(['company_industry_name' => '房地產業']);
        company_industry::create(['company_industry_name' => '租賃和商務服務業']);
        company_industry::create(['company_industry_name' => '研究發展業']);
        company_industry::create(['company_industry_name' => '水利、環境和公共設施管理業']);
        company_industry::create(['company_industry_name' => '醫療機構']);
        company_industry::create(['company_industry_name' => '教育']);
        company_industry::create(['company_industry_name' => '社會保障和社會福利業']);
        company_industry::create(['company_industry_name' => '文化、體育和娛樂業']);
        company_industry::create(['company_industry_name' => '公共管理與社會組織']);
        company_industry::create(['company_industry_name' => '國際組織']);
        company_industry::create(['company_industry_name' => '公共行政及國防']);
        company_industry::create(['company_industry_name' => '出版、影音製作、傳播']);
        company_industry::create(['company_industry_name' => '營造工程業']);
        company_industry::create(['company_industry_name' => '不動產業']);
        company_industry::create(['company_industry_name' => '網際網路業']);

        company_type::create(['company_type_name' => '一般公司']);
        company_type::create(['company_type_name' => '上市公司']);
        company_type::create(['company_type_name' => '上櫃公司']);
        company_type::create(['company_type_name' => '財團法人']);
        company_type::create(['company_type_name' => '非營利之社團法人']);

        plan::create(['plan_name' => '180天免費方案']);
        plan::create(['plan_name' => '免授權費方案']);
        plan::create(['plan_name' => 'POC']);
        plan::create(['plan_name' => '經銷/合作']);
        plan::create(['plan_name' => '客製版專案']);
        plan::create(['plan_name' => '服務型']);
        plan::create(['plan_name' => '授權型(直售)']);
        plan::create(['plan_name' => '公協會']);
        plan::create(['plan_name' => '公益平台']);
        plan::create(['plan_name' => '50人-官網']);
        plan::create(['plan_name' => '50人-業務']);
        plan::create(['plan_name' => 'MA']);
        plan::create(['plan_name' => '1000人以上5%方案']);
        
    }
}
