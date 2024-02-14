<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request = $request->all();

        $lastDocumentNumber = TransactionHeader::latest()->first('Document_Number');


        if ($lastDocumentNumber == null) {
            $documentNumber = "001";
        } else {
            $documentNumber = sprintf("%03d", ((int) $lastDocumentNumber->Document_Number + 1));
        }

        $transactionHeader = [
            'Document_Code' => 'TRX',
            'Document_Number' => $documentNumber,
            'User' => Auth::user()->User,
            'Total' => 0,
            'Date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $transactionDetail = [];

        foreach ($request as $key => $value) {
            // Check Product
            $product = Product::where('id', $value['id'])->first();

            if ($product === null) {
                return response()->json([
                    'message' => "Item not found"
                ], 400);
            }

            // Check Quantity
            $quantity = (int) $value['qty'];
            if (!is_int($quantity) || $quantity <= 0) {
                return response()->json([
                    'message' => "Item quantity is invalid"
                ], 400);
            }

            $price = $product->Price - (($product->Discount / 100) * $product->Price);

            $transactionHeader['Total'] += $value['qty'] * $price;

            $transactionDetail[] = [
                'Document_Code' => 'TRX',
                'Document_Number' => $documentNumber,
                'Product_Code' => $product->Product_Code,
                'Price' => $price,
                'Quantity' => $value['qty'],
                'Unit' => $product->Unit,
                'Sub_Total' => $value['qty'] * $price,
                'Currency' => 'IDR',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        try {
            DB::beginTransaction();

            TransactionHeader::insert($transactionHeader);
            TransactionDetail::insert($transactionDetail);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'An error occurred.',
                'error' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Transactions saved successfully'
        ]);
    }

    public function index()
    {
        $filter_start = isset($_GET['date_start']) ? $_GET['date_start'] : '';
        $filter_end = isset($_GET['date_end']) ? $_GET['date_end'] : '';

        $transactions = TransactionHeader::with('details');
        if ($filter_start !== '') $transactions->where('Date', '>=', $filter_start);
        if ($filter_end !== '') $transactions->where('Date', '<=', $filter_end);
        $transactions = $transactions->get()->toArray();

        foreach ($transactions as $key => $value) {
            $transactions[$key]['Date'] = date('d M Y', strtotime($value['Date']));
        }

        return response()->json([
            'data' => $transactions
        ]);
    }

    public function cetak_pdf()
    {
        $filter_start = isset($_GET['date_start']) ? $_GET['date_start'] : '';
        $filter_end = isset($_GET['date_end']) ? $_GET['date_end'] : '';

        $transactions = TransactionHeader::with('details');
        if ($filter_start !== '') $transactions->where('Date', '>=', $filter_start);
        if ($filter_end !== '') $transactions->where('Date', '<=', $filter_end);
        $transactions = $transactions->get()->toArray();

        foreach ($transactions as $key => $value) {
            $transactions[$key]['Date'] = date('d M Y', strtotime($value['Date']));
        }

        $pdf = \PDF::loadview('report_pdf', ['transaction' => $transactions]);
        return $pdf->download('report-penjualan.pdf');
    }
}
