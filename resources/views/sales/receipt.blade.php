<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .mb-10{
        margin-bottom:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;
    }
    .w-85{
        width:65%;
    }
    .w-15{
        width:35%;
    }
    .logo img{
        width:350px;
        height:150px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
{{--    <h1 class="m-0 p-0">Invoice</h1>--}}
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <h1 class="m-0 p-0">Invoice</h1>
        <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">#{{$sale->invoice_number}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Invoice Date - <span class="gray-color">{{\Carbon\Carbon::parse($sale->created_at)->format('d-m-Y')}}</span></p>
    </div>
    <div class="w-50 float-left logo mb-10">
        <img src="{{public_path('images/logo.png')}}" style="margin-left: 10px;" class="img img-fluid" alt="logo" >
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>Exide Express,</p>
                    <p>No 6 Chimurenga Road Rusape</p>
                    <p>Tell: (0252) 052832</p>
                    <p>Cell: 0773 377 230</p>
                    <p>Email: Muregisav@gmail.com</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p>Name: {{$sale->customer->fullname??""}},</p>
                    <p>Phone: {{$sale->customer->phone??""}},</p>
                    <p>Email: {{$sale->customer->email??""}},</p>
                    <p>Address: {{$sale->customer->address??""}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Pricing Model</th>
        </tr>
        <tr>
            <td>Cash and Carry</td>
            <td>{{ucfirst($sale->pricing_model)}}</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Product Name</th>
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">Subtotal</th>
        </tr>
        @foreach($sale->saleItems as $item)
            <tr align="center">
                <td>{{$item->product->name??""}} {{$item->product->description??""}}</td>
                <td>{{number_format($item->price,2)}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{number_format($item->sub_total,2)}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Currency</p>
                        <p>Rate</p>
                        <p>Total Paid</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{number_format($sale->saleItems->sum('sub_total'),2)}}</p>
                        <p>{{$sale->currency->name??""}}</p>
                        <p>{{$sale->rate}}</p>
                        <p>{{number_format($sale->total,2)}}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
    <p>Received in good order and condition</p>
    <br>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Name:----------------------------------------------------</p>
        </div>
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Signature:-----------------------------------------------</p>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
</body>
</html>
