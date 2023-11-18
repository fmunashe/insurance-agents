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
                <h4>All Commission Bands</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Commission Bands</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">All Commission Bands</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">All Commission Bands </h4>
                            <a href="{{route('commissions.create')}}" class="btn btn-primary">+ Add new</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Agent</th>
                                        <th>Category</th>
                                        <th>Configured Percentage</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($commissions as $commission)
                                        <tr>
                                            <td>{{$commission->id}}</td>
                                            <td>{{$commission->agent->name??""}}
                                                &nbsp;{{$commission->agent->surname??""}}</td>
                                            <td>{{$commission->riskCategory->name??""}}</td>
                                            <td>{{$commission->commission_percentage}} %</td>

                                            <td>
                                                <a href="{{route('commissions.show',$commission->id)}}"
                                                   class="btn btn-sm btn-success"><i
                                                        class="la la-eye"></i></a>
                                                <a href="{{route('commissions.edit',$commission->id)}}"
                                                   class="btn btn-sm btn-primary"><i
                                                        class="la la-pencil"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                   data-target="#confirmModal_{{$commission->id}}"><i
                                                        class="la la-trash-o"></i></a>
                                                @include('commissions.confirm')
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
