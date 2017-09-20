@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                    @yield('form.open')
                    {!! Form::model($order, ['route' => ['orders.update', $order->uid], 'method' => 'patch']) !!}

                        @include('orders.fields')

                    {!! Form::close() !!}
                    @yield('form.close')
               </div>
           </div>
       </div>
   </div>
@endsection