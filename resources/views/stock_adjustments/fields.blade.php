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
					<td>Quantity</td>
					<td>Available</td>
					<td>After</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr v-if="!product_line.length">
					<td colspan="6" align="center">No Product Line</td>
				</tr>
				<tr v-for="(line,index) in product_line">
					<th v-text="line.product.name">
					</th>
					<th v-text="line.product.category.name"></th>
					<td>
						<input type="number" class="form-control" v-model="line.quantity"
							:name="'products[' + line.product.id + '][quantity]'">
						<input type="hidden" :name="'products[' + line.product.id + '][product_id]'" v-model="line.product.id">
					</td>
					<td>
						<input type="text" readonly class="form-control" v-model="computeProductLineAvailable(line)">
					</td>
					<td>
						<input type="text" readonly class="form-control" v-model="computeProductLineAfter(line)">
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
<!-- Reason Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::text('reason', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('note', 'Note:') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stock-adjustments.index') !!}" class="btn btn-default">Cancel</a>
</div>
@section('form.close')
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
		      			 <multiselect @select="selectedOption" :options="getUnselectedProducts" label="name" v-model="new_product.product"></multiselect>
		      		</div>
		      		<div class="form-group">
		      			<label for="quantity">Quantity</label>
		      			<input v-model="new_product.quantity" required type="number" class="form-control" id="quantity">
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
					'quantity' => $p->pivot->quantity,
					'price_per_unit' => $p->pivot->price_per_unit,
					'sold_quantity' => $p->pivot->sold_quantity,
				];
			}): '[]' !!},
			products: [],
			new_product: {
				product: '',
				quantity: '',
				after: ''
			},
			inventory: {!! isset($inventory) ? $inventory : '{paid_amount : "", due_amount: 0, total_amount: 0}' !!}
		},
		computed: {
			newProductTotalAmount () {
				return (this.new_product.quantity * this.new_product.price_per_unit).toFixed(2) || ''
			},
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
				self.new_product.quantity = ''
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
					quantity: this.new_product.quantity,
				})
				$("#product-list-modal").modal('toggle')
			},
			removeProductLine (index) {
				this.product_line.splice(index, 1)
			},
			computeProductLineAvailable(line) {
				return (line.product.available_quantity)
			},
			computeProductLineAfter(line) {
				return (Number(line.product.available_quantity) + Number(line.quantity))
			}
		}
	})
</script>
@endsection