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
                <h4>Product Details</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('products.index')}}">Products</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Product Details</a></li>
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
                            <h4 class="mb-0">{{$product->name}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h2 class="card-title text-white">About {{$product->name}} </h2>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Client Name</strong>
                                    <span
                                        class="mb-0">{{$product->client->name??""}} &nbsp;{{$product->client->surname??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Client Phone</strong>
                                    <span class="mb-0">{{$product->client->mobile??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Category</strong>
                                    <span class="mb-0">{{$product->category->name??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Description</strong>
                                    <span class="mb-0 text-right">{{$product->description}}</span>
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
                <div class="card-header bg-primary">
                    <h4 class="text-white">Insurance Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                        <th>Policy Number</th>
                        <th>Provider</th>
                        <th>Currency</th>
                        <th>Sum Insured</th>
                        <th>Premium</th>
                        <th>Terms Insured</th>
                        <th>Start Period</th>
                        <th>End Period</th>
                        <th>Status</th>
                        </thead>
                        <tbody>
                        @foreach($product->insureds as $insured)
                            <tr>
                                <td>{{$insured->policy_number}}</td>
                                <td>{{$insured->provider->name??""}}</td>
                                <td>{{$insured->currency->name??""}}</td>
                                <td>{{number_format($insured->sum_insured,2)}}</td>
                                <td>{{number_format($insured->premium,2)}}</td>
                                <td>{{$insured->number_of_terms}}</td>
                                <td>{{$insured->start_date}}</td>
                                <td>{{$insured->end_date}}</td>
                                <td>
                                    <span class="badge {{$insured->status?"badge-success":"badge-danger"}}">{{$insured->status?"Active":"Not Active"}}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
