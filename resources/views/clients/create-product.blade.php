<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 17:54
 */
?>
<div class="modal fade" id="createProductModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{route('products.store')}}" method="post">
                @csrf

                <div class="modal-header bg-primary">
                    <h4 class="text-white">Add New Client Risk</h4>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
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
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <div class="form-group">
                                <label class="form-label">Risk Name</label>
                                <input type="text" value="{{old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror" name="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Risk Description</label>
                                <textarea value="{{old('description')}}"
                                          class="form-control @error('description') is-invalid @enderror"
                                          name="description"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Details</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
