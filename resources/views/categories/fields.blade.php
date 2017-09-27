<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Parent:') !!}
    {{-- <div class="input-group"> --}}
        <select name="parent" id="parent" class="form-control" data-placeholder="-- Select --">
            <option></option>
            @foreach($categories as $cat)
                @if(isset($category) && $category->parent_id == $cat->id)
                    <option selected value="{{ $cat->id }}">{{ $cat->name }}</option>
                @else
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endif
            @endforeach
        </select>
        {{-- <span class="input-group-btn">
            <button class="btn btn-default btn-md" type="button"><i class="fa fa-plus"></i></button>
        </span> --}}
    {{-- </div> --}}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('categories.index') !!}" class="btn btn-default">Cancel</a>
    @if(isset($category))
        <button class="btn btn-danger pull-right"
            formaction="{{ route('categories.destroy', $category->uid) }}"
            name="_method"
            value="DELETE">
            <i class="fa fa-trash"></i>
        </button>
    @endif
</div>
@section('css')
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.0/dist/vue-multiselect.min.css">
@endsection
@section('scripts')
{{-- <script>
    $(function () {
        $("select#parent_id").select2({
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
            },
        })
    })
</script> --}}
@endsection