<!-- Supplier Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supplier_id', 'Supplier') !!}
	<select name="supplier_id" id="supplier_id" required class="form-control" data-placeholder="-- Select --"
		style="width: 100%">
		<option></option>
		@foreach($suppliers as $supplier)
			@if(isset($inventory) && $inventory->supplier_id == $supplier->id)
				<option selected value="{{ $supplier->id }}">{{ $supplier->name }}</option>
			@else
				<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
			@endif
		@endforeach
	</select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('supplied_at', 'Date') !!}
	{!! Form::datetimeLocal('supplied_at', date('Y-m-d\TH:i'), ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-sm-12 form-group">
	<label style="margin-bottom: 10px;display: block;">
		Product Line
		<button type="button" class="btn btn-primary btn-sm pull-right"
			data-toggle="modal"
			data-target="#product-list-modal">
			<i class="fa fa-plus"></i>
			Add Product
		</button>
	</label>
	<div class="box box-default">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<td>Product</td>
					<td>Category</td>
					<td>Price Per Unit</td>
					<td>Quantity</td>
					<td>Amount</td>
				</tr>
			</thead>
			<tbody>
				<tr v-if="!product_line.length">
					<td colspan="5" align="center">No Product Line</td>
				</tr>
				<tr v-for="(line,index) in product_line">
					<th v-text="line.product.name">
					</th>
					<th v-text="line.product.category.name"></th>
					<td>
						<input type="number" class="form-control" step="0.10" v-model="line.price_per_unit"
							:name="'products[' + line.product.id + '][price_per_unit]'"
							min="0">
						<input type="hidden" :name="'products[' + line.product.id + '][product_id]'" v-model="line.product.id">
						<input type="hidden" :name="'products[' + line.product.id + '][sold_quantity]'" v-model="line.sold_quantity">
					</td>
					<td>
						<input type="number" class="form-control" v-model="line.quantity"
							:name="'products[' + line.product.id + '][quantity]'"
							:min="line.sold_quantity || 0">
					</td>
					<td>
						<input type="text" readonly class="form-control" v-model="computeProductLineTotalAmount(line)"
							:name="'products[' + line.product.id + '][total_amount]'">
					</td>
					<td>
						<button type="button" class="btn btn-sm btn-danger"
							v-if="!line.sold_quantity"
							@click="removeProductLine(index)">
							<i class="fa fa-times-circle"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="col-sm-6 form-group">
	<label for="notes">Notes</label>
	{!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 5, 'cols' => 30]) !!}
</div>
<div class="col-sm-6 form-horizontal">
	<div class="form-group">
		<label for="total_amount" class="control-label col-sm-4">Total Amount</label>
		<div class="col-sm-8">
			{!! Form::number('total_amount', null, ['class' => 'form-control', 'v-model' => 'inventory.total_amount', 'readonly']) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="paid_amount" class="control-label col-sm-4">Paid Amount</label>
		<div class="col-sm-8">
			{!! Form::number('paid_amount', null, [
				'class' => 'form-control', 'v-model' => 'inventory.paid_amount', 'step' => '0.10',
				':max' => 'inventory.total_amount'
			]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="due_amount" class="control-label col-sm-4">Due</label>
		<div class="col-sm-8">
			{!! Form::text('due_amount', null, ['class' => 'form-control', 'v-model' => 'inventory.due_amount', 'readonly']) !!}
		</div>
	</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventories.index') !!}" class="btn btn-default">Cancel</a>
</div>
@section('form.end')
<div class="modal fade" tabindex="-1" role="dialog" id="product-list-modal">
  	<form v-on:submit.prevent="addProductLine()">
  		<div class="modal-dialog" role="document">
  		  	<div class="modal-content">
				<div class="modal-header">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      			<h4 class="modal-title">Add Product</h4>
	    		</div>
	    		<div class="modal-body">
		      		<div class="form-group">
		      			<label for="product">Product</label>
		      			{{-- <select required class="form-control" style="width: 100%" data-placeholder="-- Select --">
		      				<option></option>
		      				<option v-for="product in getUnselectedProducts" :value="product.id" v-text="product.name"
		      					:key="product.name"></option>
		      			</select>
		      			 --}}
		      			 <multiselect :options="getUnselectedProducts" label="name" v-model="new_product.product"></multiselect>
		      		</div>
		      		<div class="form-group">
		      			<label for="price_per_unit">Price Per Unit</label>
		      			<input v-model="new_product.price_per_unit" required type="number" step="0.10" class="form-control" id="price_per_unit">
		      		</div>
		      		<div class="form-group">
		      			<label for="quantity">Quantity</label>
		      			<input v-model="new_product.quantity" required type="number" class="form-control" id="quantity">
		      		</div>
		      		<div class="form-group">
		      			<label for="quantity">Amount</label>
		      			<input v-model="new_product.total_amount" disabled type="number" class="form-control" id="total_amount">
		      		</div>
	    		</div>
	    		<div class="modal-footer">
	      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      			<button type="submit" class="btn btn-primary">Add</button>
	    		</div>
  		  	</div><!-- /.modal-content -->
		</div>
  	</form>
</div>
@endsection
@section('scripts')
<script>
	new Vue({
		el: '.content',
		data: {
			product_line: {!! isset($inventory) ? $inventory->products->map(function ($p) {
				return [
					'id' => $p->id,
					'product' => $p,
					'total_amount' => $p->pivot->total_amount,
					'quantity' => $p->pivot->quantity,
					'price_per_unit' => $p->pivot->price_per_unit,
					'sold_quantity' => $p->pivot->sold_quantity,
				];
			}): '[]' !!},
			products: [],
			new_product: {
				product: '',
				price_per_unit: '',
				quantity: '',
				total_amount: '',
			},
			inventory: {!! isset($inventory) ? $inventory : '{paid_amount : "", due_amount: 0, total_amount: 0}' !!}
		},
		computed: {
			newProductTotalAmount () {
				return (this.new_product.quantity * this.new_product.price_per_unit).toFixed(2) || ''
			},
			getUnselectedProducts () {
				var products = this.product_line.map(line => line.product.id)

				return this.products.filter(p => {
					return products.indexOf(p.id) < 0
				})
			},
		},
		watch: {
			inventory: {
				handler: function (val, oldVal) {
					this.inventory.due_amount = (val.total_amount - val.paid_amount).toFixed(2)
				},
				deep: true
			},
			product_line: {
				handler: function (val, oldVal) {
					this.inventory.total_amount = this.product_line.reduce((sum, p) => {
						return sum + Number(p.total_amount)
					}, 0).toFixed(2)
					this.inventory.due_amount = (this.inventory.total_amount - this.inventory.paid_amount).toFixed(2)
				},
				deep: true,
			},
			new_product: {
				handler: function (val, oldVal) {
					this.new_product.price_per_unit = val.product.cost_price
					this.new_product.total_amount = val.price_per_unit * val.quantity
				},
				deep: true
			}
		},
		created () {
			this.getProducts()
		},
		mounted () {
			var self = this

			$("#product-list-modal select").on("change", function () {
				var product = _.find(self.products, { 'id': Number($(this).val())})
				self.new_product.product = product
			})
			$("#product-list-modal").on('hidden.bs.modal', function (e) {
				self.new_product.product = ''
				self.new_product.price_per_unit = ''
				self.new_product.quantity = ''
				self.new_product.total_amount = ''
			})
		},
		methods: {
			getProducts () {
				axios.get('/api/products', {
						params: {
							limit: 1000,
							with: 'category'
						}
					})
					.then((response) => {
					 	this.products = response.data.data.data
					})
			},
			addProductLine() {
				this.product_line.push({
					product: this.new_product.product,
					price_per_unit: this.new_product.price_per_unit,
					quantity: this.new_product.price_per_unit,
					total_amount: this.new_product.total_amount
				})
				$("#product-list-modal").modal('toggle')
			},
			removeProductLine (index) {
				this.product_line.splice(index, 1)
			},
			computeProductLineTotalAmount(line) {
				return line.total_amount = (line.price_per_unit * line.quantity).toFixed(2) || null
			}
		}
	})
</script>
@endsection
