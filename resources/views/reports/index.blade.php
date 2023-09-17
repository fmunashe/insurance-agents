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
                <h4>Sales Report</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">Sales</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">All Sales Reports</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">Sales Report </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('generateSalesReport')}}" method="post">
                                @csrf
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" value=""
                                               class="form-control @error('startDate') is-invalid @enderror"
                                               name="startDate">
                                        @error('startDate')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input type="date" value=""
                                               class="form-control @error('endDate') is-invalid @enderror"
                                               name="endDate">
                                        @error('endDate')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Report Type</label>
                                        <select class="form-control @error('reportType') is-invalid @enderror" name="reportType">
                                            <option value="excel">Excel</option>
{{--                                            <option value="pdf">PDF</option>--}}
                                        </select>
                                        @error('reportType')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label text-white">.</label>
                                        <input type="submit" value="Generate Report" class="form-control btn-primary text-white">
                                    </div>
                                </div>


                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
