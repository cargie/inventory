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
            <select name="category" required id="category" class="form-control" data-placeholder="-- Select --">
                <option></option>
                @foreach($categories as $category)
                    @if(isset($product) && $product->category_id == $category->id)
                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
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
</div>

@section('scripts')
<script>
    new Vue({
        el: '.content',
        data: {
            attributes: {!! isset($product) ? (isset($product->attribute) ? json_encode($product->attribute) : '[]') : '[]' !!},
            nkey: '',
            nvalue: '',
        },
        methods: {
            addAttribute () {
                this.attributes.push({key: this.nkey, value: this.nvalue})
                this.nkey = ''
                this.nvalue = ''
            },
            removeAttribute (index) {
                this.attributes.splice(index, 1)
            }
        }
    })
</script>
@endsection