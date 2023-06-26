<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaperSize;
use Illuminate\Support\Facades\DB;

class CoverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('covers')->insert([
            'name'       => json_encode(['ar' => 'غلاف 1', 'en' => 'cover1' ]) ,
            'price'       => 50,
            'image'              => 'cover1.jpg',
            'back_img'              => 'cover2.jpg',
            'edge_img'              => 'cover3.jpg',
//            'file_3d'              => 'tinker.obj',
            'created_at'              => \Carbon\Carbon::now(),
            ]);

        DB::table('covers')->insert([
            'name'       => json_encode(['ar' => 'غلاف 2', 'en' => 'cover2' ]) ,
            'price'       => 100,
            'image'              => 'cover4.jpg',
            'back_img'              => 'cover5.jpg',
            'edge_img'              => 'cover6.jpg',
//            'file_3d'              => 'tinker.obj',
            'created_at'              => \Carbon\Carbon::now(),
        ]);
    }
}
