<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            "id"=>1,
            "name"=>"English"
        ]);
        Language::create([
            "id"=>2,
            "name"=>"Indonesia"
        ]);
        Language::create([
            "id"=>3,
            "name"=>"Arab"
        ]);
    }
    
}
