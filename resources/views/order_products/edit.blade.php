@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order Product
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderProduct, ['route' => ['orderProducts.update', $orderProduct->id], 'method' => 'patch']) !!}

                        @include('order_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection