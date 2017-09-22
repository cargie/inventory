<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('roles', 'Roles:') !!}
    <div class="checkbox well well-sm">
	    @foreach($roles as $role)
			<label>
				@if(isset($user) && $user->hasRole($role))
					<input type="checkbox" name="roles[]" checked value="{{ $role->id }}"> {{ $role->name }}
				@else
					<input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }}
				@endif
			</label><br>
	    @endforeach
    </div>
</div>

<!-- Password Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
@section('css')
<style>
	.radio label, .checkbox label {
		padding-left: 0px;
	}
</style>
@endsection