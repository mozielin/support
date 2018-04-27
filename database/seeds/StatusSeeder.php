<?php

use Illuminate\Database\Seeder;

use App\status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        status::create(['status_name' => '尚未簽約','status_class' => '合約']);
        status::create(['status_name' => '已簽約未驗收','status_class' => '合約']);
        status::create(['status_name' => '維護階段(MA)','status_class' => '合約']);
        status::create(['status_name' => '失效','status_class' => '合約']);
        status::create(['status_name' => '毋需簽約','status_class' => '合約']);

        status::create(['status_name' => '聯繫中','status_class' => '案件']);
        status::create(['status_name' => '客戶評估中','status_class' => '案件']);
        status::create(['status_name' => '客戶整備中','status_class' => '案件']);
        status::create(['status_name' => '已簽約未發版','status_class' => '案件']);
        status::create(['status_name' => '申請發版中','status_class' => '案件']);
        status::create(['status_name' => '已發版','status_class' => '案件']);
        status::create(['status_name' => '移至公有雲','status_class' => '案件']);
        status::create(['status_name' => '移轉他方案','status_class' => '案件']);
        status::create(['status_name' => '結案','status_class' => '案件']);
        status::create(['status_name' => '到期','status_class' => '案件']);

        status::create(['status_name' => '有效','status_class' => 'Lic']);  
        status::create(['status_name' => '逾期','status_class' => 'Lic']);
    }
}
