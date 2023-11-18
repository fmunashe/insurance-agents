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
                <h4>Add Commission Band</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('commissions.index')}}">Commission Bands</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Commission Band</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">Commission Band Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('commissions.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
                                <div class="form-group">
                                    <label class="form-label">Risk Category</label>
                                    <select value="{{old('product_category_id')}}"
                                            class="form-control @error('product_category_id') is-invalid @enderror"
                                            name="product_category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Commission Percentage</label>
                                    <input type="number" value="{{old('commission_percentage')}}" min="1" step="0.1"
                                           class="form-control @error('commission_percentage') is-invalid @enderror"
                                           name="commission_percentage">
                                    @error('commission_percentage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('commissions.index')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
