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
                <h4>New Order</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('orders.index')}}">Orders</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">New Order</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <livewire:orders.create-order/>
    </div>
@endsection
