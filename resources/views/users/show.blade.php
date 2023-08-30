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
            <h4>User Details</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Users</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">User Details</a></li>
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
                        <h4 class="mb-0">{{$user->name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="card-title text-white">About {{$user->name}} </h2>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Email</strong>
                                <span class="mb-0">{{$user->email}}</span>
                            </li>
                            <li class="list-group-item d-flex px-0 justify-content-between">
                                <strong>Role</strong>
                                <span class="mb-0">{{$user->role}}</span>
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
{{--            <div class="card-body">--}}
{{--                        <div class="table-responsive recentOrderTable">--}}
{{--                            <table class="table verticle-middle table-responsive-md">--}}
{{--                                <thead class="bg-primary text-white">--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Date</th>--}}
{{--                                    <th scope="col">Company</th>--}}
{{--                                    <th scope="col" class="text-nowrap">Contact Person</th>--}}
{{--                                    <th scope="col">Phone</th>--}}
{{--                                    <th scope="col">Notes</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($user->callSummary as $summary)--}}
{{--                                    <tr>--}}
{{--                                        <td class="text-nowrap">{{$summary->date}}</td>--}}
{{--                                        <td>{{$summary->company}}</td>--}}
{{--                                        <td>{{$summary->contact_person}}</td>--}}
{{--                                        <td>{{$summary->phone_number}}</td>--}}
{{--                                        <td>{{$summary->notes}}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}

{{--            </div>--}}
        </div>
    </div>
</div>
@endsection
