<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'ID:') !!}
    <p>{!! $category->uid !!}</p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $category->name !!}</p>
</div>

<!-- Slug Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{!! $category->slug !!}</p>
</div> --}}

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $category->description !!}</p>
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Parent:') !!}
    <p>{!! optional($category->parent)->name !!}</p>
</div>

