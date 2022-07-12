<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                "owner_id" => 1,
                "name" => "○○○店",
                "information" => "ここに店舗情報が入ります。ここに店舗情報が入ります。ここに店舗情報が入ります。ここに店舗情報が入ります。",
                "filename" => "sample1.jpg",
                "is_selling" => true,
            ],
            [
                "owner_id" => 2,
                "name" => "○○○店",
                "information" => "ここに店舗情報が入ります。ここに店舗情報が入ります。ここに店舗情報が入ります。ここに店舗情報が入ります。",
                "filename" => "sample2.jpg",
                "is_selling" => true,
            ],
        ]);
    }
}
