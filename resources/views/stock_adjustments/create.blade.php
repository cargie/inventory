@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Stock Adjustment
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    @yield('form.open')
                    {!! Form::open(['route' => 'stock-adjustments.store']) !!}

                        @include('stock_adjustments.fields')

                    {!! Form::close() !!}
                    @yield('form.close')
                </div>
            </div>
        </div>
    </div>
@endsection
