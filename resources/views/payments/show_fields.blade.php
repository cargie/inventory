<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $payment->id !!}</p>
</div>

<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{!! $payment->order_id !!}</p>
</div>

<!-- Paid At Field -->
<div class="form-group">
    {!! Form::label('paid_at', 'Paid At:') !!}
    <p>{!! $payment->paid_at !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{!! $payment->amount !!}</p>
</div>

<!-- Mode Field -->
<div class="form-group">
    {!! Form::label('mode', 'Mode:') !!}
    <p>{!! $payment->mode !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $payment->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $payment->updated_at !!}</p>
</div>

