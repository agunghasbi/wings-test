<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "Product";

    protected $fillable =
    [
        'Product_Code',
        'Product_Name',
        'Price',
        'Currency',
        'Discount',
        'Dimension',
        'Unit',
        'created_at',
        'updated_at'
    ];
}
