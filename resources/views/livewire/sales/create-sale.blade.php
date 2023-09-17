<div class="col-xl-12 col-xxl-12 col-sm-12" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="card-title text-white">Sale Details Info</h5>
            <span class="btn btn-info pull-right"><a href="{{route('sales.create')}}" class="la la-refresh">Refresh</a> </span>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Cashier</label>
                            <input type="text" readonly value="{{auth()->user()->name}}"
                                   class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Currency</label>
                            <select class="form-control @error('currencyId') is-invalid @enderror"
                                    wire:model="currencyId">
                                <option value="">Select Currency</option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency['id']}}">{{$currency['name']}}</option>
                                @endforeach
                            </select>
                            @error('currencyId')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Pricing Type</label>
                            <select class="form-control @error('pricingType') is-invalid @enderror"
                                    wire:model="pricingType">
                                <option value="">Select Pricing Type</option>
                                    <option value="retail">Retail Price</option>
                                    <option value="dealer">Dealer Price</option>
                            </select>
                            @error('pricingType')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Customer Fullname</label>
                            <input type="text"
                                   class="form-control @error('fullname') is-invalid @enderror" wire:model="fullname">
                            @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Customer Phone</label>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Customer Email</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror" wire:model="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Customer Address</label>
                            <input type="email"
                                   class="form-control @error('address') is-invalid @enderror" wire:model="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <select type="text" class="form-control" wire:model="productId.0">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{$product['id']}}">{{$product['name']}}</option>
                                @endforeach
                            </select>
                            @error('productId.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <input type="number" readonly class="form-control" wire:model="price.0"
                                   placeholder="Enter Price">
                            @error('price.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <input type="number" readonly class="form-control" wire:model="availableStock.0"
                                   placeholder="Available Stock">
                            @error('availableStock.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <input type="number" class="form-control" wire:model="quantity.0"
                                   placeholder="Enter Quantity">
                            @error('quantity.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <input type="number" readonly class="form-control" wire:model="subTotal.0"
                                   placeholder="Subtotal">
                            @error('subTotal.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <button class="btn text-white btn-success btn-sm" wire:click.prevent="add({{$i}})">Add Field
                        </button>
                    </div>
                    {{--                    </div>--}}


                    @foreach($inputs as $key => $value)
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" wire:model="productId.{{$value}}">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{$product['id']}}">{{$product['name']}}</option>
                                    @endforeach
                                </select>
                                @error('productId.'.$value) <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <input type="number" readonly class="form-control" wire:model="price.{{ $value }}"
                                       placeholder="Enter Price">
                                @error('price.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <input type="number" readonly class="form-control" wire:model="availableStock.{{ $value }}"
                                       placeholder="Available Stock">
                                @error('availableStock.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <input type="number" class="form-control" wire:model="quantity.{{ $value }}"
                                       placeholder="Enter Quantity">
                                @error('quantity.'.$value) <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="form-group">
                                <input type="number" class="form-control" wire:model="subTotal.{{ $value }}"
                                       placeholder="Enter Subtotal">
                                @error('subTotal.'.$value) <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Remove</button>
                        </div>
                    @endforeach

                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                            </div>
                            <div class="card-footer">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td>Currency</td>
                                        <td>{{$filteredCurrency['name']??""}}</td>
                                    </tr>
                                    <tr>
                                        <td>Rate</td>
                                        <td>{{$filteredCurrency['rate']??""}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>{{number_format($total,2)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" wire:click.prevent="store" class="btn btn-primary">Submit</button>
                        <a href="{{route('sales.index')}}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
