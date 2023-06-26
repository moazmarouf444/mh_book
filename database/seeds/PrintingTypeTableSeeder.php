<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Printing;

class PrintingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('printings')->insert([
            'name'       => json_encode(['ar' => 'عادي', 'en' => 'normal' ]) ,
            'price'       => 50,
            'created_at'              => \Carbon\Carbon::now(),
        ]);

        DB::table('printings')->insert([
            'name'       => json_encode(['ar' => 'الوان', 'en' => 'colors' ]) ,
            'price'       => 70,
            'created_at'              => \Carbon\Carbon::now(),
        ]);
    }
}
