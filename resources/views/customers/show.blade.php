@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Customer
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row" style="padding-left: 20px">
                            @include('customers.show_fields')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <a href="{!! route('customers.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
@endsection
