@extends('layouts.app')

@section('content')
 <section class="content-header">
     <h1>
         Dashboard
     </h1>
</section>
@inject('metrics', 'App\Services\MetricsService')
<div class="content">
    <div class="row">
        <div class="col-sm-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $metrics->total_revenue() }}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
                <div href="{{ route('orders.index') }}" class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $metrics->orders_today() }}</h3>
                    <p>Today's Order</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{ route('orders.index') }}" class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{ $metrics->reorderable_products() }}</h3>
                    <p>Reorderable Products</p>
                </div>
                <div class="icon">
                    <i class="fa fa-product-hunt"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
