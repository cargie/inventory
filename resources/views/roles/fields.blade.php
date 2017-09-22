<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permissions', 'Permissions:') !!}
   	<div class="checkbox well well-sm">
   		<div class="row">
	    	@foreach ($permissions->chunk(3) as $chunk)
				<div class="col-sm-6">
					@foreach($chunk as $permission)
						@if(isset($role) && $role->hasPermissionTo($permission))
							<label>
								<input type="checkbox" checked name="permissions[{{$permission->id}}]" value="{{ $permission->id }}"> {{ $permission->name }}
							</label><br>
						@else
							<label>
								<input type="checkbox" name="permissions[{{$permission->id}}]" value="{{ $permission->id }}"> {{ $permission->name }}
							</label><br>
						@endif
					@endforeach
				</div>
	    	@endforeach
   		</div>
   	</div>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script>
	$(function() {
		$("select").select2('destroy')
	})
</script>
@endsection
@section('css')
<style>
	.radio label, .checkbox label {
		padding-left: 0px;
	}
</style>
@endsection