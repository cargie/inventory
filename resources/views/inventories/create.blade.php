@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventory
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    @yield('form.open')
                    {!! Form::open(['route' => 'inventories.store']) !!}

                        @include('inventories.fields')

                    {!! Form::close() !!}
                    @yield('form.close')
                </div>
            </div>
        </div>
    </div>
@endsection
