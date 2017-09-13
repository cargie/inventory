@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inventory
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                    @yield('form.start')
                   {!! Form::model($inventory, ['route' => ['inventories.update', $inventory->id], 'method' => 'patch']) !!}

                        @include('inventories.fields')

                   {!! Form::close() !!}
                   @yield('form.end')
               </div>
           </div>
       </div>
   </div>
@endsection