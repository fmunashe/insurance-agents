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
                <h4>Adverts</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Adverts</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Adverts</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">Adverts </h4>
                            <a href="{{route('adverts.create')}}" class="btn btn-primary">+ Upload New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Banner</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($adverts as $advert)
                                        <tr>
                                            <td>{{$advert->id}}</td>
                                            <td>{{$advert->title}}</td>
                                            <td>{{$advert->description}}</td>
                                            <td> <span class="badge {{$advert->status?"badge-success":"badge-danger"}}">{{$advert->status?"Active":"In-Active"}}</span></td>
                                            <td>  <img src="{{ Storage::url('uploads/'.$advert->banner_url) }}" alt="banner" class="img img-fluid" height="100" width="100"></td>
                                            <td>
                                                <a href="{{route('adverts.show',$advert->id)}}"
                                                   class="btn btn-sm btn-success"><i
                                                        class="la la-eye"></i></a>
                                                <a href="{{route('adverts.edit',$advert->id)}}"
                                                   class="btn btn-sm btn-info"><i
                                                        class="la la-pencil"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                   data-target="#confirmModal_{{$advert->id}}"><i
                                                        class="la la-trash-o"></i></a>
                                                @include('adverts.confirm')
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
