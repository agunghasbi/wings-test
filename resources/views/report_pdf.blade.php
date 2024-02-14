<!DOCTYPE html>
<html>

<head>
    <title>Report Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Report Penjualan</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Transaction</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction as $key => $value)
            <tr>
                <td>{{$value['Document_Code'] . ' - '. $value['Document_Number']}}</td>
                <td>{{$value['User']}}</td>
                <td>Rp. {{number_format($value['Total'],0)}}</td>
                <td>{{$value['Date']}}</td>
                <td>
                    @foreach($value['details'] as $detailKey => $detailValue)
                    {{$detailValue['Product_Name'] . ' X '. $detailValue['Quantity']}}<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>