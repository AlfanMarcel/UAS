<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            ['nama' => 'pabrik obat',],
            ['nama' => 'pabrik',],
        ];

        DB::table('suppliers')->insert($category);
    }
}
