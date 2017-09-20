@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventory
            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i>
                Edit
            </a>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="date">Date</label>
                                <p>{{ $inventory->supplied_at->format("M d, Y H:i A") }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="total_amount">Total Amount</label>
                                <p>{{ $inventory->total_amount }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="paid_amount">Paid Amount</label>
                                <p>{{ $inventory->paid_amount }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="due_amount">Due</label>
                                <p>{{ $inventory->due_amount }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="notes">Note</label>
                                <p>{{ $inventory->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>Inventory Items</h4>
                <div class="box box-primary">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Product</td>
                                <td>Category</td>
                                <td>Price Per Unit</td>
                                <td>Quantity</td>
                                <td>Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ optional($product->category)->name }}</td>
                                    <td>{{ $product->pivot->price_per_unit }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->pivot->total_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Supplier
                        </h3>
                    </div>
                    <div class="box-body">
                        <dl>
                            <dt>ID</dt>
                            <dd><a href="{{ route('suppliers.show', $inventory->supplier->uid) }}">
                                {{ $inventory->supplier->uid }}
                            </a></dd>
                            <dt>Name</dt>
                            <dd>{{ $inventory->supplier->name }}</dd>
                            <dt>Email</dt>
                            <dd><a href="mailto:{{ $inventory->supplier->email }}">{{ $inventory->supplier->email }}</a></dd>
                            <dt>Phone</dt>
                            <dd><abbr title="Phone">P:</abbr> {{ $inventory->supplier->phone }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <a href="{!! route('inventories.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
@endsection
