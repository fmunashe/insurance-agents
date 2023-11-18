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
                <h4>Client Details</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('clients.index')}}">Clients</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Client Details</a></li>
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
                            <h4 class="mb-0">{{$client->name}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h2 class="card-title text-white">About {{$client->name}} </h2>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Surname</strong>
                                    <span class="mb-0">{{$client->surname}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Email</strong>
                                    <span class="mb-0">{{$client->email}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Gender</strong>
                                    <span class="mb-0">{{$client->gender}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Phone</strong>
                                    <span class="mb-0">{{$client->mobile}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>ID Number</strong>
                                    <span class="mb-0">{{$client->id_number}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Address</strong>
                                    <span class="mb-0 text-right">{{$client->address}}</span>
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

                            <h4 class="text-white">Risks</h4>

                            <span>
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                               data-target="#createProductModal"><i
                                    class="la la-plus"> Add Risk</i></a>

                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                               data-target="#createInsuranceModal"><i
                                    class="la la-plus"> Attach Insurance</i></a>

                            </span>


                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Risk Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client->products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->category->name??""}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                       data-target="#showProductModal_{{$product->id}}"><i
                                            class="la la-eye">  View</i></a>

                                    @include('clients.show-product')
                                    <a href="{{route('products.edit',$product->id)}}"
                                       class="btn btn-sm btn-primary"><i
                                            class="la la-pencil"> Edit</i></a>
                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                       data-target="#confirmModal_{{$product->id}}"><i
                                            class="la la-trash-o"> Delete</i></a>
                                    @include('products.confirm')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('clients.create-insurance')
    @include('clients.create-product')

@endsection
