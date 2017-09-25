@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Stock Adjustment Product
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'stockAdjustmentProducts.store']) !!}

                        @include('stock_adjustment_products.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
