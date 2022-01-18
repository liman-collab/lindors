<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fature</title>
    <head>
        {{--        <title>{{ $invoice->name }}</title>--}}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css" media="screen">
            html {
                font-family: sans-serif;
                line-height: 0.2 !important;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: collapse;

            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                /*border-top: 1px solid #dee2e6;*/
            }

            .table thead th {
                vertical-align: bottom;
                /*border-bottom: 2px solid #dee2e6;*/
            }

            .table tbody + tbody {
                /*border-top: 2px solid #dee2e6;*/
            }

            .mt-5 {
                margin-top: 3rem !important;
            }

            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }

            * {
                font-family: "DejaVu Sans";
            }

            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .seller-name{
                line-height: 1.1;
            }

            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }

            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }

            .border-0 {
                border: none !important;
            }
        </style>
    </head>


</head>

<body class="p-0 m-0">

<table class="table m-0 p-0">
    <tbody>
    <tr>
        <td class="pl-0 m-0" width="70%">
            <div class="align-items-center">

                <h4 class="text-uppercase">
                    <strong>Lindor Stake House</strong>
                </h4>
            </div>

        </td>
        <td>
            <p>Serial Number: <strong>#{{$serialNumber}}</strong></p>
            <p>Data: <strong>#{{$data}}</strong></p>
            <p>Useri : <strong>{{Auth::user()->name}}</strong></p>
        </td>
    </tr>
    </tbody>
</table>
<hr>
<table class="table table-bordered">
    <thead>
    <tr>

        <th scope="col">Arka</th>
        <th scope="col">POS</th>
        <th scope="col">Pazari Ditor</th>
        <th scope="col">Shpenzimet</th>
        <th scope="col">Mbetja</th>
    </tr>
    </thead>
    <tbody><tr>




            <td>
                @foreach($arkas as $arka)

                {{ $arka->input}} Euro
                @endforeach
            </td>




            <td>
                @foreach($pos as $arkaPos)
                {{ $arkaPos->input}} Euro
                @endforeach
            </td>




            <td>
                @foreach($orders as $order)
                {{ $order->input}} Euro
                @endforeach
            </td>




            <td> {{$expenses->sum('total')}} Euro</td>




            <td>
                @foreach($orders as $order)

                {{ $order->input - $expenses->sum('total')}} Euro

                @endforeach
            </td>


    </tr>
    </tbody>
</table>



</body>

</html>
