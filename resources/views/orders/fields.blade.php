<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer', 'Customer:') !!}
    <select name="customer" id="customer" required class="form-control" data-placeholder="-- Select --">
        <option></option>
        @foreach($customers as $customer)
            @if(isset($order) && $order->customer_id == $customer->id)
                <option selected value="{{ $customer->id }}">{{ $customer->name }}</option>
            @else
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('mode', 'Mode:') !!}
    {!! Form::select('mode', ['walk-in' => 'Walk In', 'online' => 'Online'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('ordered_at', 'Date:') !!}
    {!! Form::datetimeLocal('ordered_at', date('Y-m-d\TH:i'), ['class' => 'form-control','required']) !!}
</div>

<div class="col-sm-12">
    <div class="form-group">
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
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <td>Product</td>
                        <td>Category</td>
                        <td>Price Per Unit</td>
                        <td>Quantity</td>
                        <td>Discount</td>
                        <td>Vat</td>
                        <td>Amount</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="!product_line.length">
                        <td colspan="8" align="center">No Product Line</td>
                    </tr>
                    <tr v-for="(line,index) in product_line">
                        <th v-text="line.product.name">
                        </th>
                        <th v-text="line.product.category.name"></th>
                        <td>
                            <input type="number" class="form-control" step="0.10" v-model="line.price_per_unit"
                                :name="'products[' + line.product.id + '][price]'"
                                min="0">
                            <input type="hidden" :name="'products[' + line.product.id + '][product_id]'" v-model="line.product.id">
                        </td>
                        <td>
                            <input type="number" class="form-control" v-model="line.quantity"
                                :name="'products[' + line.product.id + '][quantity]'"
                                :min="line.sold_quantity || 1"
                                :max="line.product.available_quantity">
                        </td>
                        <td>
                            <input type="number" class="form-control" v-model="line.discount"
                                :name="'products[' + line.product.id + '][discount]'"
                                :min="0">
                        </td>
                        <td>
                            <input type="number" step="0.10" class="form-control" v-model="line.vat" 
                                :name="'products[' + line.product.id + '][vat]'"
                                :min="0">
                        </td>
                        <td>
                            <input type="text" readonly class="form-control" v-model="computeProductLineTotalAmount(line)"
                                :name="'products[' + line.product.id + '][amount]'">
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
</div>

{{-- <div class="col-sm-6 form-group">
    <label for="notes">Notes</label>
    {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 5, 'cols' => 30]) !!}
</div> --}}
<div class="col-sm-6 col-sm-offset-6 form-horizontal">
    <div class="form-group">
        <label for="total_amount" class="control-label col-sm-4">Total Amount</label>
        <div class="col-sm-8">
            {!! Form::number('total_amount', null, ['class' => 'form-control', 'v-model' => 'inventory.total_amount', 'readonly']) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="total_amount" class="control-label col-sm-4">Total Discount</label>
        <div class="col-sm-8">
            {!! Form::number('total_amount', null, ['class' => 'form-control', 'v-model' => 'total_discount', 'disabled']) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="total_amount" class="control-label col-sm-4">Total VAT</label>
        <div class="col-sm-8">
            {!! Form::number('total_amount', null, ['class' => 'form-control', 'v-model' => 'total_vat', 'disabled']) !!}
        </div>
    </div>
    <div v-if="!inventory.id">
        <div class="form-group">
            <label for="paid_amount" class="control-label col-sm-4">Paid Amount</label>
            <div class="col-sm-8">
                {!! Form::number('paid_amount', null, [
                    'class' => 'form-control', 'v-model' => 'inventory.paid_amount', 'step' => '0.10',
                    ':max' => 'inventory.total_amount',
                    ':disabled' => '!inventory.total_amount'
                ]) !!}
            </div>
        </div>
        <div v-if="inventory.paid_amount > 0">
            <div class="form-group" >
                <label for="payment_mode" class="control-label col-sm-4">Payment Type</label>
                <div class="col-sm-8">
                    {!! Form::select('payment_mode', ['cash' => 'Cash', 'cheque' => 'Cheque', 'credit' => 'Credit Card', 'debit' => 'Debit Card'],
                        null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group" >
                <label for="payment_note" class="control-label col-sm-4">Payment Note</label>
                <div class="col-sm-8">
                    {!! Form::textarea('payment_note',null, ['class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>
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
    {!! Form::submit('Place Order', ['class' => 'btn btn-primary pull-right']) !!}
    <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
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
                        <multiselect :options="getUnselectedProducts" id="new_product" label="name" v-model="new_product.product"
                            @select="selectedOption"></multiselect>
                    </div>
                    <div class="form-group">
                        <label for="price_per_unit">Price Per Unit</label>
                        <input v-model="new_product.price_per_unit" required type="number" step="0.10" class="form-control" id="price_per_unit">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input v-model="new_product.quantity" required type="number" class="form-control" id="quantity"
                            min="1" :max="new_product.product.available_quantity">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input v-model="new_product.discount" step="0.10" type="number" class="form-control" id="discount">
                    </div>
                    <div class="form-group">
                        <label for="vat">VAT</label>
                        <input v-model="new_product.vat" step="0.10" type="number" class="form-control" id="vat">
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Amount</label>
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
            product_line: {!! isset($order) ? $order->products->map(function ($p) {
                return [
                    'id' => $p->id,
                    'product' => $p,
                    'total_amount' => $p->pivot->amount,
                    'quantity' => $p->pivot->quantity,
                    'vat' => $p->pivot->vat,
                    'discount' => $p->pivot->discount,
                    'price_per_unit' => $p->pivot->price,
                ];
            }): '[]' !!},
            products: [],
            new_product: {
                product: '',
                price_per_unit: '',
                quantity: '',
                total_amount: '',
                vat: 0,
                discount: 0
            },
            inventory: {!! isset($order) ? $order : '{paid_amount : "", due_amount: 0.00, total_amount: 0.00}' !!}
        },
        computed: {
            newProductTotalAmount () {
                return (this.new_product.quantity * this.new_product.price_per_unit).toFixed(2) || ''
            },
            total_discount () {
                return this.product_line.reduce((sum, p) => {
                    return sum + Number(p.discount)
                }, 0).toFixed(2)
            },
            total_vat () {
                return this.product_line.reduce((sum, p) => {
                    return sum + Number(p.vat)
                }, 0).toFixed(2)
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
                    this.new_product.total_amount = (val.price_per_unit * val.quantity) - Number(val.discount) + Number(val.vat)
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
                self.new_product.vat = 0
                self.new_product.discount = 0
            })

            $("#new_product").attr('required', 'required')

        },
        methods: {
            getProducts () {
                axios.get('/api/products', {
                        params: {
                            limit: 1000,
                            with: 'category',
                            search: 'available_quantity:0',
                            searchFields: 'available_quantity:>'
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
                    quantity: this.new_product.quantity,
                    discount: this.new_product.discount,
                    vat: this.new_product.vat,
                    total_amount: this.new_product.total_amount,
                })
                $("#product-list-modal").modal('toggle')
            },
            removeProductLine (index) {
                this.product_line.splice(index, 1)
            },
            computeProductLineTotalAmount(line) {
                return line.total_amount = ((line.price_per_unit * line.quantity) - Number(line.discount) + Number(line.vat)).toFixed(2) || null
            },
            selectedOption (selectedOption, id) {
                this.new_product.price_per_unit = selectedOption.selling_price
            }
        }
    })
</script>
@endsection