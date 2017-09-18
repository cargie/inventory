<!-- Order Id Field -->
<div class="row">
	<div class="col-sm-6">
		<div class="form-group col-sm-12">
		    {!! Form::label('order', 'Order:') !!}
		    <select name="order" id="order" class="form-control" required data-placeholder="-- Select --" style="width: 100%">
		    	<option></option>
		    	@foreach($orders as $order)
					<option value="{{ $order->id }}">{{ $order->uid }}</option>
		    	@endforeach
		    </select>
		</div>

		<!-- Mode Field -->
		<div class="form-group col-sm-12">
		    {!! Form::label('mode', 'Mode:') !!}
		    {!! Form::select('mode',
		    	['cash' => 'Cash', 'cheque' => 'Cheque', 'credit' => 'Credit', 'debit' => 'Debit'], null,
		    	['class' => 'form-control', 'style' => 'width:100%', 'required']) !!}
		</div>

		<!-- Amount Field -->
		<div class="form-group col-sm-12">
		    {!! Form::label('amount', 'Amount:') !!}
		    {!! Form::number('amount', null, ['class' => 'form-control','required', 'min' => 0.01, 'step' => 0.01]) !!}
		</div>

		<!-- Submit Field -->
		<div class="form-group col-sm-12">
		    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		    <a href="{!! route('payments.index') !!}" class="btn btn-default">Cancel</a>
		</div>

	</div>
</div>