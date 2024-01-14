<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 17:54
 */
?>
<div class="modal fade" id="createInsuranceModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{route('insurance.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Attach Insurance To Existing Risk</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <div class="form-group">
                                <label class="form-label">Select Risk</label>
                                <select value="{{old('product_id')}}"
                                        class="form-control @error('product_id') is-invalid @enderror"
                                        name="product_id">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Insurance Provider</label>
                                <select class="form-control @error('supplier_id') is-invalid @enderror"
                                        name="supplier_id">
                                    @foreach($providers as $provider)
                                        <option value="{{$provider->id}}">{{$provider->name}}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Currency</label>
                                <select class="form-control @error('currency_id') is-invalid @enderror"
                                        name="currency_id">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->name}}</option>
                                    @endforeach
                                </select>
                                @error('currency_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Sum Insured</label>
                                <input type="number" value="{{old('sum_insured')}}"
                                       class="form-control @error('sum_insured') is-invalid @enderror"
                                       name="sum_insured">
                                @error('sum_insured')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Premium</label>
                                <input type="number" step="0.1" min="0" value="{{old('premium')}}"
                                       class="form-control @error('premium') is-invalid @enderror" name="premium">
                                @error('premium')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Stamp Duty</label>
                                <input type="number" step="0.1" min="0" value="{{old('stamp_duty')}}"
                                       class="form-control @error('stamp_duty') is-invalid @enderror" name="stamp_duty">
                                @error('stamp_duty')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Levy</label>
                                <input type="number" step="0.1" min="0" value="{{old('levy')}}"
                                       class="form-control @error('levy') is-invalid @enderror" name="levy">
                                @error('levy')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Policy Number</label>
                                <input type="text" value="{{old('policy_number')}}"
                                       class="form-control @error('policy_number') is-invalid @enderror"
                                       name="policy_number">
                                @error('policy_number')
                                <span class="invalid-feedback" role="policy_number">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Insured Period Start Date</label>
                                <input type="date" value="{{old('start_date')}}"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       name="start_date">
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Insured Period End Date</label>
                                <input type="date" value="{{old('end_date')}}"
                                       class="form-control @error('end_date') is-invalid @enderror"
                                       name="end_date">
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Choose Commission Band</label>
                                <select class="form-control @error('commission_id') is-invalid @enderror"
                                        name="commission_id">
                                    @foreach($bands as $band)
                                        <option value="{{$band->id}}">{{$band->riskCategory->name??""}}</option>
                                    @endforeach
                                </select>
                                @error('commission_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Rate</label>
                                <input type="number" step="0.1" min="0" value="{{old('rate')}}"
                                       class="form-control @error('rate') is-invalid @enderror" name="rate">
                                @error('rate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Number of Terms</label>
                                <input type="number" step="0.1" min="0" value="{{old('number_of_terms')}}"
                                       class="form-control @error('number_of_terms') is-invalid @enderror"
                                       name="number_of_terms">
                                @error('number_of_terms')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Policy Status</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Policy Schedule Document</label>
                                <input type="file" class="form-control @error('policy_schedule') is-invalid @enderror"
                                       name="policy_schedule"/>

                                @error('policy_schedule')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Insurance Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
