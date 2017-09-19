@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($user, ['/profile', 'method' => 'post']) !!}
                        @include('profile.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection