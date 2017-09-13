<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer:') !!}
    <select name="customer_id" id="customer_id" class="form-control" data-placeholder="-- Select --">
        <option></option>
        @foreach($customers as $customer)
            @if(isset($order) && $order->customer_id == $customer->id)
                <option selected value="{{ $customer->id }}">{{ $customer->name }}</option>
            @else
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('mode', 'Mode:') !!}
    {!! Form::select('mode', ['walk-in' => 'Walk In', 'online' => 'Online'], null, ['class' => 'form-control']) !!}
</div>


<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::number('total_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Paid Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paid_amount', 'Paid Amount:') !!}
    {!! Form::number('paid_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
