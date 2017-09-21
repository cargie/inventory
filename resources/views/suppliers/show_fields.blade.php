<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'ID:') !!}
    <p>{!! $supplier->uid !!}</p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $supplier->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    <p>
        <a href="mailto:{!! $supplier->email !!}">{!! $supplier->email !!}</a>
    </p>
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    <p><abbr title="Phone">P:</abbr> {!! $supplier->phone !!}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $supplier->description !!}</p>
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_active', 'Active:') !!}
    <p>
        @if($supplier->is_active) 
            <span class="label label-success">Active</span>
        @else
            <span class="label label-default">Inactive</span>
        @endif
    </p>
</div>

{{-- <!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $supplier->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $supplier->updated_at !!}</p>
</div> --}}

