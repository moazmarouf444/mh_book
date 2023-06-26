<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Frame;

class FrameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frames')->insert([
            'name'       => json_encode(['ar' => 'اطار 1', 'en' => 'frame 1' ]) ,
            'price'       => 50,
            'image'              => 'frame1.jpg',
            'created_at'              => \Carbon\Carbon::now(),
        ]);

        DB::table('frames')->insert([
            'name'       => json_encode(['ar' => 'اطار 2', 'en' => 'frame2' ]) ,
            'price'       => 100,
            'image'              => 'frame2.jpg',
            'created_at'              => \Carbon\Carbon::now(),
        ]);
    }
}
