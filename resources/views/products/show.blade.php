@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product
            <a href="{{ route('products.edit', $product->uid) }}" class="btn btn-primary pull-right">
                <i class="fa fa-pencil fa-fw"></i>
                Edit
            </a>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Info
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="id">ID</label>
                                <p>{{ $product->uid }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="name">Name</label>
                                <p>{{ $product->name }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="code">Code</label>
                                <p>{{ $product->code }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="category">Category</label>
                                <p>{{ optional($product->category)->name }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="description">Description</label>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Pricing
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="cost_price">Cost Price</label>
                                <p>{{ $product->cost_price }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="selling_price">Selling Price</label>
                                <p>{{ $product->selling_price }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="vat">VAT</label>
                                <p>{{ $product->vat }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Inventory
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="reorder_point">Reorder Point</label>
                                <p>{{ $product->reorder_point }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="opening_stock">Opening Stock</label>
                                <p>{{ $product->opening_stock }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="available_quantity">Available Quantity</label>
                                <p>{{ $product->available_quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <a href="{!! route('products.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
@endsection
