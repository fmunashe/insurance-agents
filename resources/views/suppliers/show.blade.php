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
            <h4>Suppliers Details</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('suppliers.index')}}">Suppliers</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Suppliers Details</a></li>
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
                        <h4 class="mb-0">{{$supplier->name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="card-title text-white">About {{$supplier->name}} </h2>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Name</strong>
                                <span class="mb-0">{{$supplier->name}}</span>
                            </li>
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Phone</strong>
                                <span class="mb-0">{{$supplier->phone}}</span>
                            </li>
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Email</strong>
                                <span class="mb-0">{{$supplier->email}}</span>
                            </li>
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Address</strong>
                                <span class="mb-0">{{$supplier->address}}</span>
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

            </div>
        </div>
    </div>
</div>
@endsection
