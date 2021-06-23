<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'id' => '1804100',
                'name' => 'MENS SHOES BLACK',
                'category' => 'shoes',
                'gender' => 'MEN',
                'color' => 'black',
                'regular_price' => '2000',
                'sale_price' => '1600',
            ],
            [
                'id' => '1252100',
                'name' => 'MENS SHIRTS BLACK',
                'category' => 'shirts',
                'gender' => 'MEN',
                'color' => 'black',
                'regular_price' => '1000',
                'sale_price' => '800',
            ],
            [
                'id' => '1423100',
                'name' => 'MENS PANTS BLACK',
                'category' => 'pants',
                'gender' => 'MEN',
                'color' => 'black',
                'regular_price' => '1000',
                'sale_price' => '800',
            ],
            [
                'id' => '1831100',
                'name' => 'MENS SHOES WHITE',
                'category' => 'shoes',
                'gender' => 'MEN',
                'color' => 'white',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '1255100',
                'name' => 'MENS SHIRTS WHITE',
                'category' => 'shirts',
                'gender' => 'MEN',
                'color' => 'white',
                'regular_price' => '2000',
                'sale_price' => '1600',
            ],
            [
                'id' => '1457100',
                'name' => 'MENS PANTS WHITE',
                'category' => 'pants',
                'gender' => 'MEN',
                'color' => 'white',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '2825100',

                'name' => 'WOMENS SHOES BLACK',
                'category' => 'shoes',
                'gender' => 'WOMEN',
                'color' => 'black',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '2286100',
                'name' => 'WOMENS SHIRTS BLACK',
                'category' => 'shirts',
                'gender' => 'WOMEN',
                'color' => 'black',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '2432100',
                'name' => 'WOMENS PANTS BLACK',
                'category' => 'pants',
                'gender' => 'WOMEN',
                'color' => 'black',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '2826100',
                'name' => 'WOMENS SHOES WHITE',
                'category' => 'shoes',
                'gender' => 'WOMEN',
                'color' => 'white',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '2266100',
                'name' => 'WOMENS SHIRTS WHITE',
                'category' => 'shirts',
                'gender' => 'WOMEN',
                'color' => 'white',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
            [
                'id' => '2412100',
                'name' => 'WOMENS PANTS WHITE',
                'category' => 'pants',
                'gender' => 'WOMEN',
                'color' => 'white',
                'regular_price' => '3000',
                'sale_price' => '2400',
            ],
        ]);
    }
}
