@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventory Product
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inventoryProduct, ['route' => ['inventoryProducts.update', $inventoryProduct->id], 'method' => 'patch']) !!}

                        @include('inventory_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection