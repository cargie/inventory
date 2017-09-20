@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Category
            <a href="{{ route('categories.show', $category->uid) }}" class="btn btn-primary pull-right">{{ $category->uid }}</a>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            @include('categories.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{!! route('categories.index') !!}" class="btn btn-default">
            <i class="fa fa-angle-double-left"></i>
            Back</a>
    </div>
@endsection
