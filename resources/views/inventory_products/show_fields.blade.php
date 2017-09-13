<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $inventoryProduct->id !!}</p>
</div>

<!-- Inventory Id Field -->
<div class="form-group">
    {!! Form::label('inventory_id', 'Inventory Id:') !!}
    <p>{!! $inventoryProduct->inventory_id !!}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{!! $inventoryProduct->product_id !!}</p>
</div>

<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{!! $inventoryProduct->quantity !!}</p>
</div>

<!-- Price Per Unit Field -->
<div class="form-group">
    {!! Form::label('price_per_unit', 'Price Per Unit:') !!}
    <p>{!! $inventoryProduct->price_per_unit !!}</p>
</div>

<!-- Total Amount Field -->
<div class="form-group">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    <p>{!! $inventoryProduct->total_amount !!}</p>
</div>

<!-- Sold Quantity Field -->
<div class="form-group">
    {!! Form::label('sold_quantity', 'Sold Quantity:') !!}
    <p>{!! $inventoryProduct->sold_quantity !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $inventoryProduct->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $inventoryProduct->updated_at !!}</p>
</div>

