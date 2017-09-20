@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    @yield('form.open')
                    {!! Form::open(['route' => 'products.store']) !!}

                        @include('products.fields')

                    {!! Form::close() !!}
                    @yield('form.close')
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
<script>
    $(function () {
        $("select#category").select2({
            allowClear: true,
            ajax: {
                url: '/api/categories',
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page,
                        orderBy: 'name',
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1
                    return {
                        results: _.map(data.data.data, function (data) {
                            return { id: data.id, text: data.name }
                        }),
                        pagination: {
                            more: (params.page * 10) < data.data.total
                        }
                    }
                }
            },
        })
        $("select#tags").select2({
            ajax: {
                url: '/api/tags',
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page,
                        orderBy: 'name',
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1
                    console.log(data)
                    return {
                        results: _.map(data.data.data, function (data) {
                            return { id: data.id, text: data.name }
                        }),
                        pagination: {
                            more: (params.page * 10) < data.data.total
                        }
                    }
                }
            }
        })
    })
</script>
@endsection --}}