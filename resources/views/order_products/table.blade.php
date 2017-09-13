<table class="table table-responsive" id="orderProducts-table">
    <thead>
        <th>Order Id</th>
        <th>Product Id</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Discount</th>
        <th>Var</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($orderProducts as $orderProduct)
        <tr>
            <td>{!! $orderProduct->order_id !!}</td>
            <td>{!! $orderProduct->product_id !!}</td>
            <td>{!! $orderProduct->quantity !!}</td>
            <td>{!! $orderProduct->price !!}</td>
            <td>{!! $orderProduct->amount !!}</td>
            <td>{!! $orderProduct->discount !!}</td>
            <td>{!! $orderProduct->var !!}</td>
            <td>
                {!! Form::open(['route' => ['orderProducts.destroy', $orderProduct->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderProducts.show', [$orderProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orderProducts.edit', [$orderProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>