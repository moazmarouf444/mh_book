<?php

use Database\Seeders\CoverTableSeeder;
use Database\Seeders\EducationTableSeeder;
use Database\Seeders\FrameTableSeeder;
use Database\Seeders\PrintingTypeTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(IntroHowWorkTableSeeder::class);
        $this->call(IntroSliderTableSeeder::class);
        $this->call(IntroServiceTableSeeder::class);
        $this->call(IntroFqsCategoryTableSeeder::class);
        $this->call(IntroFqsTableSeeder::class);
        $this->call(IntroPartenerTableSeeder::class);
        $this->call(IntroSocialTableSeeder::class);
        $this->call(SocialTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(FqsTableSeeder::class);
        $this->call(IntroTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(CouponTableSeeder::class);
        $this->call(SmsTableSeeder::class);
//        $this->call(NotificationSeeder::class);
        $this->call(PaperSizeTableSeeder::class);
        $this->call(CoverTableSeeder::class);
        $this->call(FrameTableSeeder::class);
//        $this->call(EducationTableSeeder::class);
        $this->call(PrintingTypeTableSeeder::class);
    }
}
