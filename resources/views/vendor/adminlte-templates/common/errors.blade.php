@if(!empty($errors))
    @if($errors->any())
        <ul class="alert alert-danger alert-dismissable" style="list-style-type: none" data-dismiss="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	  <span aria-hidden="true">&times;</span>
        	</button>
            @foreach($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endif
@endif
