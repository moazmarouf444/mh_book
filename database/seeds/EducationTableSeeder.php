<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_levels')->insert([
            'name' => json_encode(['ar' => 'مدرسه', 'en' => 'School']),
            'input_name' => json_encode(['ar' => 'اسم المدرسه', 'en' => 'School Name']),
            'created_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('education_levels')->insert([
            'name' => json_encode(['ar' => 'جامعه', 'en' => 'University']),
            'input_name' => json_encode(['ar' => 'اسم الجامعه', 'en' => 'University Name']),
            'created_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('education_levels')->insert([
            'name' => json_encode(['ar' => 'معهد', 'en' => 'Institute']),
            'input_name' => json_encode(['ar' => 'اسم المعهد', 'en' => 'University Name']),
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
