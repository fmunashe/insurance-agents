<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sale Receipt </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 60px;

            /** Extra personal styles **/
            background-color: #014c84;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        header p {
            font-size: 25px;
            margin-top: 8px;
            background-color: #014c84;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 60px;
            font-size: 20px !important;
            color: white;
        !important;

            /** Extra personal styles **/
            background-color: #014c84;
            text-align: center;
            line-height: 35px;
        }

        h4 {
            color: gray;
        }

        table thead{
            background-color: #ff7e01;
        }

    </style>
</head>
<body>

<h2>Invoice: {{$sale->invoice_number}}</h2>
<h2>Date: {{\Carbon\Carbon::parse($sale->created_at)->format('Y-m-d')}}</h2>
<h2>Cashier: {{$sale->cashier->name??""}}</h2>


<img src="{{public_path('images/logo.png')}}" style="margin-left: 10px;" class="img img-fluid" >
    <div class="card">
        <div class="card-body">
            <table class="table table-sm">
                <thead class="text-white">
                <th>Product</th>
                <th>Quantity Sold</th>
                <th>USD Price</th>
                <th>SubTotal</th>
                </thead>
                <tbody>
                @foreach($sale->saleItems as $item)
                    <tr>
                        <td>{{$item->product->name??""}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->price,2)}}</td>
                        <td>{{number_format($item->sub_total,2)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            <div class="row mt-4">--}}
{{--                <div class="col-md-5">--}}
                    <table class="table table-sm mt-4">
                        <tr>
                            <td>SubTotal</td>
                            <td>{{number_format($sale->saleItems->sum('sub_total'),2)}}</td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>{{$sale->currency->name??""}}</td>
                        </tr>
                        <tr>
                            <td>Rate</td>
                            <td>{{$sale->rate}}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($sale->total,2)}}</td>
                        </tr>
                    </table>
{{--                </div>--}}
{{--            </div>--}}
        </div>
        {!! QrCode::size(300)->generate($sale->invoice_number) !!}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
