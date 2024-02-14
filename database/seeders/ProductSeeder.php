<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'Product_Code' => 'SKUSKILNP',
                'Product_Name' => 'So Klin Pewangi',
                'Price' => 15000,
                'Currency' => 'IDR',
                'Discount' => 10,
                'Dimension' => '13 cm x 10 cm',
                'Unit' => 'PCS',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Product_Code' => 'SKUGVBR',
                'Product_Name' => 'Giv Biru',
                'Price' => 11000,
                'Currency' => 'IDR',
                'Discount' => 0,
                'Dimension' => '5 cm x 5 cm',
                'Unit' => 'PCS',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Product_Code' => 'SKUSKLNLQD',
                'Product_Name' => 'So Klin Liquid',
                'Price' => 11000,
                'Currency' => 'IDR',
                'Discount' => 0,
                'Dimension' => '13 cm x 10 cm',
                'Unit' => 'PCS',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Product_Code' => 'EMRLVLHBLALV',
                'Product_Name' => 'Emeron Lovely HBL Aloevera',
                'Price' => 8000,
                'Currency' => 'IDR',
                'Discount' => 10,
                'Dimension' => '13 cm x 10 cm',
                'Unit' => 'PCS',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ];

        Product::insert($products);
    }
}
