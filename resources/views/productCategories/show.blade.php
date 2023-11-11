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
            <h4>Category Details</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('productCategories.index')}}">Product Categories</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Category Details</a></li>
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
                        <h4 class="mb-0">{{$productCategory->name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="card-title text-white">About {{$productCategory->name}} </h2>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Category</strong>
                                <span class="mb-0">{{$productCategory->name}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer pt-0 pb-0 text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-xxl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                        <div class="table-responsive recentOrderTable">
                            <table class="table verticle-middle table-responsive-md">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-nowrap">Description</th>
                                    <th scope="col">Sum Insured</th>
                                    <th scope="col">Premium</th>
                                    <th scope="col">Rate</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productCategory->products as $product)
                                    <tr>
                                        <td class="text-nowrap">{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->sum_insured}}</td>
                                        <td>{{$product->premium}}</td>
                                        <td>{{$product->rate}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

            </div>
        </div>
    </div>
</div>
@endsection
