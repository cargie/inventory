<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
</div>

<!-- Cost Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cost_price', 'Cost Price:') !!}
    {!! Form::number('cost_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Selling Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('selling_price', 'Selling Price:') !!}
    {!! Form::number('selling_price', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Discount Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('discount', 'Discount:') !!}
    {!! Form::number('discount', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Vat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vat', 'Vat:') !!}
    {!! Form::number('vat', null, ['class' => 'form-control']) !!}
</div>

<div class="row">
    <div class="col-sm-12">
        <!-- Reorder Point Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('reorder_point', 'Reorder Point:') !!}
            {!! Form::number('reorder_point', null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Opening Stock Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('opening_stock', 'Opening Stock:') !!}
            {!! Form::number('opening_stock', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="row">
        <!-- Category Id Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('category', 'Category:') !!}
            <div class="input-group">
                <select name="category" required id="category" class="form-control" data-placeholder="-- Select --"
                    style="width: 100%;">
                    <option></option>
                    @foreach($categories as $category)
                        @if(isset($product) && $product->category_id == $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->name . ' - ' . $category->uid }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name . ' - ' . $category->uid }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" style="padding: 5px 12px"
                        data-toggle="modal"
                        data-target="#add-category-modal">
                        <i class="fa fa-plus"></i>
                    </button>
                </span>
            </div>
        </div>
        <input type="hidden" name="tags[]">
        <div class="form-group col-sm-6">
            {!! Form::label('tags', 'Tags:') !!}
            <select name="tags[]" id="tags" multiple class="form-control" data-placeholder="-- Select --">
                <option></option>
                @foreach($tags as $tag)
                    @if(isset($product) && $product->tags()->find($tag->id))
                        <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @else
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="attributes">Attributes:</label>
            <div class="row" v-for="(attrib,index) in attributes" :key="index">
                <div class="col-xs-6">
                    <input type="text" v-model="attrib.key" placeholder="key" class="form-control"
                        :required="index != attributes.length -1" :name="'attribute[' + index + '][key]'">
                </div>
                <div class="col-xs-6">
                    <div class="input-group">
                        <input type="text" v-model="attrib.value" placeholder="value" class="form-control"
                            :required="index != attributes.length -1" :name="'attribute[' + index + '][value]'">
                        <span class="input-group-btn">
                            <button class="btn btn-default" @click="removeAttribute(index)" type="button">
                                <i class="fa fa-lg fa-minus-circle"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <input type="text" v-model="nkey" placeholder="key" class="form-control">
                </div>
                <div class="col-xs-6">
                    <div class="input-group">
                        <input type="text" v-model="nvalue" placeholder="value" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" @click="addAttribute()" type="button">
                                <i class="fa fa-lg fa-plus-circle"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
    @if(isset($product))
        <button class="btn btn-danger pull-right"
            formaction="{{ route('products.destroy', $product->uid) }}"
            name="_method"
            value="DELETE">
            <i class="fa fa-trash"></i>
        </button>
    @endif
</div>

@section('form.close')
<div class="modal fade" tabindex="-1" role="dialog" id="add-category-modal">
    <form v-on:submit.prevent="addCategory()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="parent">Parent</label>
                        <select name="parent" id="parent" class="form-control" style="width: 100%" data-placeholder="-- Select --">
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name . ' - ' . $category->uid }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="category.name" required type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea v-model="category.description" rows="5" class="form-control" id="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
            attributes: {!! isset($product) ? (isset($product->attribute) ? json_encode($product->attribute) : '[]') : '[]' !!},
            nkey: '',
            nvalue: '',
            category: {
                name: '',
                description: '',
                parent: '',
            }
        },
        mounted () {
            var self = this
            $("#add-category-modal").on('hidden.bs.modal', function () {
                self.category = {
                    name: '',
                    description: '',
                    parent: '',
                }
            })
        },
        methods: {
            addAttribute () {
                this.attributes.push({key: this.nkey, value: this.nvalue})
                this.nkey = ''
                this.nvalue = ''
            },
            removeAttribute (index) {
                this.attributes.splice(index, 1)
            },
            addCategory () {
                var parent = $("select#parent").val()
                axios.post('/api/categories', {
                    parent: parent,
                    name: this.category.name,
                    description: this.category.description
                }).then((response) => {
                    var option = new Option(response.data.data.name + ' - ' + response.data.data.uid, response.data.data.id)
                    var option2 = new Option(response.data.data.name + ' - ' + response.data.data.uid, response.data.data.id)
                    option.selected = true

                    $("#parent").append(option2)
                    $("#parent").val('')
                    $("#parent").trigger('change')

                    $("#category").append(option)
                    $("#category").trigger('change')

                    $("#add-category-modal").modal('toggle')
                }).catch((response) => {
                    alert(response.data)
                })
            }
        }
    })
</script>
@endsection