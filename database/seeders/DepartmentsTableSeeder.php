<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Nette\Utils\Random;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Department::truncate();
        Schema::enableForeignKeyConstraints();
        $faker = Faker::create('vi_VN');
        $limit = 5;
        for ($i = 0; $i < $limit; $i++){
            Department::create([
                'name' => $faker->colorName,
                'manager' => $faker->lastName,
                'address' => 'Monstarlab',
            ]);
        }
    }
}