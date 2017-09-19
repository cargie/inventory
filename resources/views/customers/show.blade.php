@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Customer
            <a href="{{ route('customers.edit', $customer->uid) }}" class="btn btn-primary btn-sm pull-right">
                <i class="fa fa-pencil"></i>
                Edit</a>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            Orders
                        </h3>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Date</td>
                                <td>Total Quantity</td>
                                <td>Amount</td>
                                <td>Paid Amount</td>
                                <td>Due Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customer->orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('orders.show', $order->uid) }}">{{ $order->uid }}</a>
                                    </td>
                                    <td>{{ $order->created_at->format("M d, Y H:i A") }}</td>
                                    <td>{{ $order->products->sum('pivot.quantity') }}</td>
                                    <td></td>
                                    <td>{{ $order->paid_amount }}</td>
                                    <td>{{ $order->due_amount }}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            Info
                        </h3>
                    </div>
                    <div class="box-body">
                        <dl class="">
                            <dt>Name</dt>
                            <dd><a href="{{ route('customers.show', $customer->uid) }}">{{ $customer->name }}</a></dd>
                            <dt>Email</dt>
                            <dd><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></dd>
                            <dt>Phone</dt>
                            <dd>{{ $customer->phone }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <a href="{!! route('customers.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
@endsection
