<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category' => 'Food'],
            ['category' => 'Electronics'],
            ['category' => 'Anything']
        ];
        DB::table('categories')->insert($categories);
    }
}
