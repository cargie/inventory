<table class="table table-responsive" id="inventoryProducts-table">
    <thead>
        <th>Inventory Id</th>
        <th>Product Id</th>
        <th>Quantity</th>
        <th>Price Per Unit</th>
        <th>Total Amount</th>
        <th>Sold Quantity</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($inventoryProducts as $inventoryProduct)
        <tr>
            <td>{!! $inventoryProduct->inventory_id !!}</td>
            <td>{!! $inventoryProduct->product_id !!}</td>
            <td>{!! $inventoryProduct->quantity !!}</td>
            <td>{!! $inventoryProduct->price_per_unit !!}</td>
            <td>{!! $inventoryProduct->total_amount !!}</td>
            <td>{!! $inventoryProduct->sold_quantity !!}</td>
            <td>
                {!! Form::open(['route' => ['inventoryProducts.destroy', $inventoryProduct->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inventoryProducts.show', [$inventoryProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inventoryProducts.edit', [$inventoryProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>