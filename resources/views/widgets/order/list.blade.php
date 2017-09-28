<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Orders list with due</h3>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Customer</td>
				<td>Due Amount</td>
				<td>Date</td>
			</tr>
		</thead>
		<tbody>
			@forelse($orders as $order)
				<tr>
					<td>
						<a href="{{ route('orders.show', $order->uid) }}">{{ $order->uid }}</a>
					</td>
					<td>
						<a href="{{ route('customers.show', $order->customer->uid) }}">{{ $order->customer->name }}</a>
					</td>
					<td>
						{{ $order->due_amount }}
					</td>
					<td>{{ $order->ordered_at->format("M d, Y H:i") }}</td>
				</tr>
			@empty
				<tr>
					<td colspan="4" align="center">No Order</td>
				</tr>
			@endforelse
		</tbody>
	</table>
</div>