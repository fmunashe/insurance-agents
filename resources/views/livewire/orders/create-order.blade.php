<div class="col-xl-12 col-xxl-12 col-sm-12" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="card-title text-white">Order Details Info</h5>
            <span class="btn btn-info pull-right"><a href="{{route('orders.create')}}" class="la la-refresh">Refresh</a> </span>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Supplier</label>
                            <select class="form-control @error('supplierId') is-invalid @enderror"
                                    wire:model="supplierId">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier['id']}}">{{$supplier['name']}}</option>
                                @endforeach
                            </select>
                            @error('supplierId')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12"></div>

                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-group">
                            <select type="text" class="form-control" wire:model="productId.0">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{$product['id']}}">{{$product['name'] ." ".$product['description']}}</option>
                                @endforeach
                            </select>
                            @error('productId.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-group">
                            <input type="number" class="form-control" wire:model="quantity.0"
                                   placeholder="Enter Quantity">
                            @error('quantity.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <button class="btn text-white btn-success btn-sm" wire:click.prevent="add({{$i}})">Add Field
                        </button>
                    </div>
                    {{--                    </div>--}}


                    @foreach($inputs as $key => $value)
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" wire:model="productId.{{$value}}">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{$product['id']}}">{{$product['name']." ".$product['description']}}</option>
                                    @endforeach
                                </select>
                                @error('productId.'.$value) <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="form-group">
                                <input type="number" class="form-control" wire:model="quantity.{{ $value }}"
                                       placeholder="Enter Quantity">
                                @error('quantity.'.$value) <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Remove</button>
                        </div>
                    @endforeach


                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" wire:click.prevent="store" class="btn btn-primary">Submit</button>
                        <a href="{{route('orders.index')}}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
