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
                <h4>Subscription Plans</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Plans</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Plans</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">All Subscription Plans </h4>
                            <a href="{{route('subscriptionPlan.create')}}" class="btn btn-primary">+ Add new</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tag</th>
                                        <th>Plan Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Is Active</th>
                                        <th>Currency</th>
                                        <th>Trial Period</th>
                                        <th>Trial Interval</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($plans as $plan)
                                        <tr>
                                            <td>{{$plan->id}}</td>
                                            <td>{{$plan->tag}}</td>
                                            <td>{{$plan->name}}</td>
                                            <td>{{number_format($plan->price,2)}}</td>
                                            <td>{{$plan->description}}</td>
                                            <td><span class="badge {{$plan->is_active?"badge-success":"badge-danger"}}">{{$plan->is_active?"Yes":"No"}}</span></td>
                                            <td>{{$plan->currency}}</td>
                                            <td>{{$plan->trial_period}}</td>
                                            <td>{{$plan->trial_interval}}</td>
                                            <td>
                                                <a href="{{route('subscriptionPlan.show',$plan->id)}}"
                                                   class="btn btn-sm btn-info"><i
                                                        class="la la-eye"></i></a>
                                                <a href="{{route('subscriptionPlan.edit',$plan->id)}}"
                                                   class="btn btn-sm btn-success"><i
                                                        class="la la-pencil"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                   data-target="#confirmModal_{{$plan->id}}"><i
                                                        class="la la-trash-o"></i></a>
                                                @include('subscriptions.confirm')
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
