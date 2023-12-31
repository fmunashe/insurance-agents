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
                <h4>All Policies</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Policies</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">All Policies</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">All Policies </h4>
                            <span>
                                <a href="{{route('policy.report')}}" class="btn btn-primary">Export List</a>
                           </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Risk</th>
                                        <th>Provider</th>
                                        <th>Policy Number</th>
                                        <th>Sum Insured</th>
                                        <th>Premium</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($policies as $policy)
                                        <tr>
                                            <td>{{$policy->id}}</td>
                                            <td>{{$policy->product->name??""}}</td>
                                            <td>{{$policy->provider->name??""}}</td>
                                            <td>{{$policy->policy_number}}</td>
                                            <td>{{$policy->sum_insured}}</td>
                                            <td>{{$policy->premium}}</td>
                                            <td>  <span
                                                    class="badge {{$policy->status?"badge-success":"badge-danger"}}">{{$policy->status?"Active":"Not Active"}}</span></td>

                                            <td>
                                                <a href="{{route('showPolicy',$policy->id)}}"
                                                   class="btn btn-sm btn-success"><i
                                                        class="la la-eye"></i> Show</a>
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
