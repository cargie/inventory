<!-- Inventory Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inventory_id', 'Inventory Id:') !!}
    {!! Form::select('inventory_id', ['1' => '1'], null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::select('product_id', ['1' => '1'], null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Per Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price_per_unit', 'Price Per Unit:') !!}
    {!! Form::number('price_per_unit', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::number('total_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventoryProducts.index') !!}" class="btn btn-default">Cancel</a>
</div>
