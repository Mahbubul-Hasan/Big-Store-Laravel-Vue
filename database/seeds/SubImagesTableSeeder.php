<?php

use App\Models\SubImage;
use Illuminate\Database\Seeder;

class SubImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SubImage::class, 30)->create();
    }
}
