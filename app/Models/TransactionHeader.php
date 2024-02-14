<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $table = 'Transaction_Header';

    protected $fillable = [
        'Document_Code',
        'Document_Number',
        'User',
        'Total',
        'Date',
        'created_at',
        'updated_at'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'Document_Number', 'Document_Number')
            ->join('Product', 'Product.Product_Code', '=', 'Transaction_Detail.Product_Code')
            ->select('Transaction_Detail.*', 'Product_Name');
    }
}
