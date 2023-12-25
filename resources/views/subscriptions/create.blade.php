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
                <h4>Add Subscription</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Subscription</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">Subscription Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('service.subscription')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row m-b-30">
                                            <div class="col-md-3">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-contnent">
                                                        <img class="img-fluid"
                                                             src="{{asset('images/courses/pic1.jpg')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="new-arrival-content position-relative">
                                                    <h4>Choose your preferred package</h4>

                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group row">
                                                            @foreach($plans as $plan)
                                                                <label class="radio-inline col-lg-3">
                                                                    <input type="radio" name="package"
                                                                           value="{{$plan}}">
                                                                    <p>{{$plan->name}}</p>
                                                                    <p class="price">
                                                                        {{$plan->currency}}
                                                                        &nbsp;{{number_format($plan->price)}}</p>
                                                                </label>
                                                            @endforeach
                                                        </div>
{{--                                                        <div class="form-group row">--}}
{{--                                                            <a href='https://www.paynow.co.zw/Payment/Link/?q=c2VhcmNoPXppaG92ZW0lNDBnbWFpbC5jb20mYW1vdW50PTYwMC4wMCZyZWZlcmVuY2U9U2VydmljZStTdWJzY3JpcHRpb24mbD0x' target='_blank'><img src='https://www.paynow.co.zw/Content/Buttons/Medium_buttons/button_pay-now_medium.png' style='border:0' /></a>--}}
{{--                                                        </div>--}}
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <button type="submit" class="btn btn-primary" id="card-button">
                                                            Subscribe
                                                        </button>
                                                        <a href="{{route('dashboard')}}"
                                                           class="btn btn-danger">Cancel</a>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

