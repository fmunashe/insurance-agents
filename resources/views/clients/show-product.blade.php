<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 17:54
 */
?>
<div class="modal fade" id="showProductModal_{{$product->id}}">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Insurance Details</h4>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
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
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($product->insureds as $insured)
                            <tr>
                                <td>{{$insured->policy_number}}</td>
                                <td>{{$insured->provider->name??""}}</td>
                                <td>{{$insured->currency->name??""}}</td>
                                <td>{{number_format($insured->sum_insured,2)}}</td>
                                <td>{{number_format($insured->premium,2)}}</td>
                                <td>{{$insured->number_of_terms}}</td>
                                <td>{{$insured->start_date}}</td>
                                <td>{{$insured->end_date}}</td>
                                <td>
                                    <span class="badge {{$insured->status?"badge-success":"badge-danger"}}">{{$insured->status?"Active":"Not Active"}}</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                       data-target="#confirmInsuredModal_{{$insured->id}}"><i
                                            class="la la-trash-o"></i></a>
                                    @include('clients.confirmInsured')
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
