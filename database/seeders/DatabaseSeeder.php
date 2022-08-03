<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Classes};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Class 1', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 2', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 3', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 4', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 5', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 6', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 7', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 8', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 9', 'desription' => 'Addmission Open', 'seats' => 4],
            ['name'=>'Class 10', 'desription' => 'Addmission Open', 'seats' => 4],
            //...
        ];
        
        Classes::insert($data);
    }
}
