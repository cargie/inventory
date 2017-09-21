@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supplier
            <a href="{{ route('suppliers.edit', $supplier->uid) }}" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i>
                Edit
            </a>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Info</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @include('suppliers.show_fields')
                        </div>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Supplied Products</h3>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Product</td>
                                <td>Category</td>
                                <td>Quantity</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supplier->products->groupBy('product_id') as $key => $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $product[0]->product->uid) }}">
                                            {{ $product[0]->product->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.show', $product[0]->product->category->uid) }}">{{ $product[0]->product->category->name }}</a>
                                    </td>
                                    <td>{{ $product->sum('quantity') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" align="center">
                                        No Product Supplied
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="box-header">
                        <h3 class="box-title">Inventory Logs</h3>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Inventory</td>
                                <td>Date</td>
                                <td>Total Amount</td>
                                <td>Paid Amount</td>
                                <td>Due</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supplier->inventories as $inventory)
                                <tr>
                                    <td>
                                        <a href="{{ route('inventories.show', $inventory->id) }}">{{ $inventory->id }}</a>
                                    </td>
                                    <td>
                                        {{ $inventory->supplied_at->format("M d, Y H:i A") }}
                                    </td>
                                    <td>
                                        {{ $inventory->total_amount }}
                                    </td>
                                    <td>{{ $inventory->paid_amount }}</td>
                                    <td>{{ $inventory->due_amount }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" align="center">No Inventory Logs</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{!! route('suppliers.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
@endsection
