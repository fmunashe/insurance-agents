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
                <h4>Policy Details</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('policies')}}">Policies</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Policy Details</a></li>
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
                            <h4 class="mb-0">{{$policy->policy_number}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h2 class="card-title text-white">About {{$policy->policy_number}} </h2>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Client Name</strong>
                                    <span
                                        class="mb-0">{{$policy->product->client->name??""}} &nbsp;{{$policy->product->client->surname??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Client Phone</strong>
                                    <span class="mb-0">{{$policy->product->client->mobile??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Risk Category</strong>
                                    <span class="mb-0">{{$policy->product->category->name??""}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Description</strong>
                                    <span class="mb-0 text-right">{{$policy->product->description}}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Policy Document</strong>
                                    <span class="mb-0 text-right"><a href="{{route('insurance.show',$policy->id)}}" class="btn btn-sm btn-warning text-white"><i class="la la-download text-white"></i> Download</a></span>
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
                    <h4 class="text-white">Insurance Policy Details</h4>
                    <span><a href="{{route('policies')}}" class="btn btn-danger">Go Back</a> </span>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table table-sm">
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

                                <tr>
                                    <td>{{$policy->policy_number}}</td>
                                    <td>{{$policy->provider->name??""}}</td>
                                    <td>{{$policy->currency->name??""}}</td>
                                    <td>{{number_format($policy->sum_insured,2)}}</td>
                                    <td>{{number_format($policy->premium,2)}}</td>
                                    <td>{{$policy->number_of_terms}}</td>
                                    <td>{{$policy->start_date}}</td>
                                    <td>{{$policy->end_date}}</td>
                                    <td>
                                        <span
                                            class="badge {{$policy->status?"badge-success":"badge-danger"}}">{{$policy->status?"Active":"Not Active"}}</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
