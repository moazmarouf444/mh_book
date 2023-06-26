<?php


use App\Models\PaperSize;
use Illuminate\Database\Seeder;

class PaperSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaperSize::create([
            'name' => 'a3',
            'price' => 50,
        ]);

        PaperSize::create([
            'name' => 'a4',
            'price' => 60,
        ]);
    }
}
