<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'category_id' => '1',
            'name' => 'barang 1',
            'price' => 1000,
            'quantity' => 3,
            'image' => 'image 1'
        ]);

        Item::create([
            'category_id' => '2',
            'name' => 'barang 2',
            'price' => 2000,
            'quantity' => 4,
            'image' => 'image 2'
        ]);

        Item::create([
            'category_id' => '3',
            'name' => 'barang 3',
            'price' => 3000,
            'quantity' => 5,
            'image' => 'image 3'
        ]);
    }
}
