<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Reorderable Product List</h3>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Category</td>
				<td>Available Quantity</td>
				<td>Reorder Point</td>
			</tr>
		</thead>
		<tbody>
			@forelse($products as $product)
				<tr>
					<td>
						<a href="{{ route('products.show', $product->uid) }}">{{ $product->uid }}</a>
					</td>
					<td>{{ $product->name }}</td>
					<td>
						<a href="{{ route('categories.show', $product->category->uid) }}">{{ optional($product->category)->name }}</a>
					</td>
					<td>
						{{ $product->available_quantity }}
					</td>
					<td>{{ $product->reorder_point }}</td>
				</tr>
			@empty
				<tr>
					<td colspan="4" align="center">No Reorderable Product</td>
				</tr>
			@endforelse
		</tbody>
	</table>
</div>