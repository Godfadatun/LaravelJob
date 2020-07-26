<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('balances')->insert([
            'amount' => 0,
            'user_id' => 1,
            'account_nr' => '08135613409',
        ]);
    }
}
