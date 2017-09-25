@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Stock Adjustment
        </h1>
   </section>
   <div class="content">
       @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                    @yield('form.open')
                    {!! Form::model($stockAdjustment, ['route' => ['stock-adjustments.update', $stockAdjustment->id], 'method' => 'patch']) !!}

                        @include('stock_adjustments.fields')

                    {!! Form::close() !!}
                    @yield('form.close')
               </div>
           </div>
       </div>
   </div>
@endsection