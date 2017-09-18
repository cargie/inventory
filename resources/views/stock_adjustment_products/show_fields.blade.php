<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $stockAdjustmentProduct->id !!}</p>
</div>

<!-- Stock Adjustment Id Field -->
<div class="form-group">
    {!! Form::label('stock_adjustment_id', 'Stock Adjustment Id:') !!}
    <p>{!! $stockAdjustmentProduct->stock_adjustment_id !!}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{!! $stockAdjustmentProduct->product_id !!}</p>
</div>

<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{!! $stockAdjustmentProduct->quantity !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $stockAdjustmentProduct->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $stockAdjustmentProduct->updated_at !!}</p>
</div>

