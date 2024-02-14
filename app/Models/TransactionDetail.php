<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'Transaction_Detail';

    protected $fillable = [
        'Document_Code',
        'Document_Number',
        'Product_Code',
        'Price',
        'Quantity',
        'Unit',
        'Sub_Total',
        'Currency',
        'created_at',
        'updated_at'
    ];

    public function transaction()
    {
        return $this->belongsTo(TransactionHeader::class, 'Document_Number', 'Document_Number');
    }
}
