@extends('layout')

@section('css')

@endsection

@section('content')
<div class="row mt-5">
    <div class="col-12">
        <a href="/" class="btn btn-warning"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali ke Home</a>
    </div>
    <div class="col-6 align-self-end">
        <h3>Report Penjualan</h3>
    </div>
    <div class="col-2">
        <label for="date_start">Date Start</label>
        <input type="date" class="form-control" id="date_start">
    </div>
    <div class="col-2">
        <label for="date_end">Date End</label>
        <input type="date" class="form-control" id="date_end">
    </div>
    <div class="col-2 align-self-end">
        <button class="btn btn-danger" id="export_pdf"> Export PDF</button>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Transaction</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody id="transactions-container">

        </tbody>
    </table>
</div>

@endsection

@section('javascript')
<script>
    let params = ''
    // Fetch Report
    function fetchReport(params = '') {
        $('#transactions-container').html("")

        $.ajax({
            type: "GET",
            url: params == '' ? "{{url('/api/transactions')}}" : `{{url('/api/transactions${params}')}}`,
            dataType: "json",
            success: function(response) {
                let data = response.data

                if (data.length == 0) {
                    $('#transactions-container').append('<tr><td colspan="5" align="center">No record found</td></tr>')
                } else {

                    $.each(data, function(i, v) {
                        let row = '<tr>';

                        row += `<td>${v.Document_Code} - ${v.Document_Number}</td>`
                        row += `<td>${v.User}</td>`
                        row += `<td>Rp. ${formatCurrency(parseInt(v.Total))},-</td>`
                        row += `<td>${v.Date}</td>`
                        let items = '';
                        $.each(v.details, function(indexDetail, valueDetail) {
                            items += valueDetail.Product_Name + ' X ' + valueDetail.Quantity + '<br>'
                        });
                        row += `<td>${items}</td>`


                        row += '</tr>'

                        $('#transactions-container').append(row)
                    });
                }

            }
        });
    }
    fetchReport()

    $('#date_start, #date_end').change(function() {
        let filter_start = $('#date_start').val();
        let filter_end = $('#date_end').val();

        params = `?date_start=${filter_start}&date_end=${filter_end}`
        fetchReport(params)
    })

    $('#export_pdf').click(function() {
        window.open(`{{url('/cetak-report${params}')}}`, '_blank');
    })

    function formatCurrency(num) {
        var str = num.toString().split('.');
        if (str[0].length >= 5) {
            str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1.');
        }
        if (str[1] && str[1].length >= 5) {
            str[1] = str[1].replace(/(\d{3})/g, '$1 ');
        }
        return str.join('.');
    }
</script>
@endsection