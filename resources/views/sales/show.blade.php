<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 15:04
 */
?>
@extends('layouts.app')
@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Sale Details</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('sales.index')}}">Sales</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Sale Details</a></li>
            </ol>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-3 col-xxl-4 col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <img class="img-fluid" src="{{asset('images/logo.png')}}" alt="">
                        <div class="card-body">
                            <h4 class="mb-0">{{$sale->invoice_number}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h2 class="card-title text-white">About {{$sale->invoice_number}} </h2>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Cashier</strong>
                                    <span class="mb-0">{{$sale->cashier->name??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Currency</strong>
                                    <span class="mb-0">{{$sale->currency->name??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Rate</strong>
                                    <span class="mb-0">{{$sale->rate}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Pricing Model</strong>
                                    <span class="mb-0">{{ucfirst($sale->pricing_model)}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Total</strong>
                                    <span class="mb-0">{{number_format($sale->total,2)}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Transaction Date</strong>
                                    <span class="mb-0">{{$sale->created_at}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer pt-0 pb-0 text-center">
                            <a href="{{route('downloadReceipt',$sale->id)}}" class="btn btn-success" target="_blank">Generate Receipt</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-xxl-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead class="bg-primary text-white">
                        <th>Product</th>
                        <th>Quantity Sold</th>
                        <th>Price</th>
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
                    <div class="row mt-4">
                        <div class="col-md-7"></div>
                        <div class="col-md-5">
                            <table class="table table-sm">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
