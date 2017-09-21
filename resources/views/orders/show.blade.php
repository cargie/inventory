@extends('layouts.app')

@section('content')
    <section class="content-header hidden-print">
        <h1>
            Order
        </h1>
    </section>
    <div class="content hidden-print">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="btn-group pull-right btn-group-sm" role="group">
                            {{-- <a href="#" class="btn btn-primary">
                                <i class="fa fa-envelope"></i>
                                Email
                            </a> --}}
                            <a href="javascript:window.print()" class="btn btn-primary">
                                <i class="fa fa-print"></i>
                                Print</a>
                            <a href="{{ route('orders.edit', $order->uid) }}" class="btn btn-primary">
                                <i class="fa fa-pencil"></i>
                                Edit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Date</label>
                                <p>{{ $order->created_at->format("M d, Y H:i A") }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Status</label>
                                <p>{{ $order->created_at->format("M d, Y H:i A") }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Total Amount</label>
                                <p>{{ $order->total_amount }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Paid Amount</label>
                                <p>{{ $order->paid_amount }}</p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Due Amount</label>
                                <p>{{ $order->due_amount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>Order Items</h4>
                <div class="box box-primary">
                    <table class="table table table-hover">
                        <thead>
                            <tr>
                                <td>Product</td>
                                <td>Category</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ optional($item->category)->name }}</td>
                                    <td>{{ ((float) $item->pivot->amount - (float) $item->pivot->discount + (float) $item->pivot->vat) / $item->pivot->quantity }}</td>
                                    <td>{{ $item->pivot->quantity }}</td>
                                    <td>{{ $item->pivot->amount }}</td>
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
                            Customer
                        </h3>
                    </div>
                    <div class="box-body">
                        <dl class="">
                            <dt>Name</dt>
                            <dd><a href="{{ route('customers.show', $order->customer->uid) }}">{{ $order->customer->name }}</a></dd>
                            <dt>Email</dt>
                            <dd><a href="mailto:{{ $order->customer->email }}">{{ $order->customer->email }}</a></dd>
                            <dt>Phone</dt>
                            <dd>{{ $order->customer->phone }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Payments
                        </h3>
                    </div>
                    <table class="table-hover table">
                        {{-- <thead>
                            <tr>
                                <td>Date</td>
                                <td>Amount</td>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @forelse($order->payments as $payment)
                                <tr>
                                    <td>{{ $payment->paid_at->format("M d, Y H:i A") }}</td>
                                    <td>{{ $payment->amount }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No Payments</td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($order->paid_amount > 0)
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <p><strong>Total Paid Amount:</strong> P {{ $order->paid_amount }}</p>
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <a href="{!! route('orders.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
    <div class="section visible-print-block invoice">
        <h2 class="page-header">
            Yorbs Electronics
            
            <small class="pull-right">
                {{ $order->created_at->format("M d, Y H:i A") }}
            </small>
        </h2>
        <div class="row">
            <div class="col-xs-4">
                From
                <address>
                    <strong>Yorbs Electronics</strong><br>
                    2nd Fl. Gillamac's Bldg., CPG Ave. <br>
                    Tagbilaran City, Bohol <br>
                    Phone: +63917-505-9268 <br>
                    Tel. No. (038) 501-9354 <br>
                    E-mail: roy@yorbs.net <br>
                </address>
            </div>
            <div class="col-xs-4">
                To
                <address>
                    <strong>{{ $order->customer->name }}</strong><br>
                    @if ($order->customer->phone)
                        Phone: {{ $order->customer->phone }} <br>
                    @endif
                    @if ($order->customer->email)
                        Email: {{ $order->customer->email }} <br>
                    @endif
                </address>
            </div>
            <div class="col-xs-4">
                <b>Order: #{{ $order->id }}</b><br><br>
                <b>Order ID:</b> {{ $order->uid }} <br>
                <b>Account:</b> {{ $order->customer->uid }} <br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->pivot->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
            </div>
            <div class="col-xs-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Tax:</th>
                            <td>{{ $order->products->sum('pivot.tax') }}</td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>{{ $order->products->sum('pivot.discount') }}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>{{ $order->total_amount }}</td>
                        </tr>
                        <tr>
                            <th>Paid:</th>
                            <td>{{ $order->paid_amount }}</td>
                        </tr>
                        <tr>
                            <th>Due:</th>
                            <td>{{ $order->due_amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
