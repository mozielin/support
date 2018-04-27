<?php

use Illuminate\Database\Seeder;

use App\bulletin;

class BulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        bulletin::create(['bulletin_name' => '系統安裝完成!', 'bulletin_content' => '666666666666666', 'builder' => '1']);
    }
}
