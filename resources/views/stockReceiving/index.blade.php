<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 15:03
 */
?>
@extends('layouts.app')
@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Received Stock</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Received Stock</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">All Received Stock</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">All Received Stock </h4>
                            <a href="{{route('stockReceiving.create')}}" class="btn btn-primary">+ Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Received By</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Order Number</th>
                                        <th>Received Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($receivedStock as $stockReceiving)
                                        <tr>
                                            <td>{{$stockReceiving->id}}</td>
                                            <td>{{$stockReceiving->capturedBy->name??""}}</td>
                                            <td>{{$stockReceiving->product->name??""}}</td>
                                            <td>{{$stockReceiving->product->description??""}}</td>
                                            <td>{{$stockReceiving->quantity}}</td>
                                            <td>{{$stockReceiving->order_number}}</td>
                                            <td>{{\Carbon\Carbon::make($stockReceiving->created_at)->format('d-M-Y')}}</td>
                                            <td>
                                                <a href="{{route('stockReceiving.edit',$stockReceiving->id)}}"
                                                   class="btn btn-sm btn-primary"><i
                                                        class="la la-pencil"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                   data-target="#confirmModal_{{$stockReceiving->id}}"><i
                                                        class="la la-trash-o"></i></a>
                                                @include('stockReceiving.confirm')
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
