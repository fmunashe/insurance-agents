<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 15:05
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>New Stock</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('stockReceiving.index')}}">Received Stock</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">New Stock</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12" xmlns:wire="http://www.w3.org/1999/xhtml">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">Stock Details Info</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('stockReceiving.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Product</label>
                                    <select type="text" class="form-control destroyer-select" name="product_id">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name." ".$product->description}}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                            name="quantity">
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Order Number</label>
                                    <input type="text" class="form-control @error('order_number') is-invalid @enderror"
                                            name="order_number">
                                    @error('order_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Receiver</label>
                                    <input type="text" readonly value="{{auth()->user()->name}}"
                                           class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('stockReceiving.index')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
