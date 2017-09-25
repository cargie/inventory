@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventory Product
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'inventoryProducts.store']) !!}

                        @include('inventory_products.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
