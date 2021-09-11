<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenizedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tokenized')->insert(
            [
                'id' => '1',
                'email_token' => 'abc@example.com',
                'first_name' => 'Eihwan',
                'last_name' => 'Kim',
                'email_address' => 'eihwan.kim@salesforce.com',
                'subkey' => 'subkey001',
            ],
            [
                'id' => '2',
                'email_token' => 'def@example.com',
                'first_name' => 'Taro',
                'last_name' => 'Yamada',
                'email_address' => 'eihwan.kim+yamada@salesforce.com',
                'subkey' => 'subkey002',
            ],
            [
                'id' => '3',
                'email_token' => 'hij@example.com',
                'first_name' => 'Taro2',
                'last_name' => 'Yamada2',
                'email_address' => 'eihwan.kim+yamada2@salesforce.com',
                'subkey' => 'subkey003',
            ],
        );
    }
}
