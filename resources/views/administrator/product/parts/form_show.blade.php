<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleFormControlInput1">Product Name</label>
            <input type="text" class="form-control" name="name"
                id="exampleFormControlInput1" placeholder="Product Name" required value="{{ old('name', $product->name) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleFormControlInput1">SKU</label>
            <input type="text" class="form-control" name="sku"
                id="exampleFormControlInput1" placeholder="Product SKU" required value="{{ old('sku', $product->sku) }}">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="exampleFormControlSelect1">Categories</label>
    <select class="form-control" id="exampleFormControlSelect1" name='categories' required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="labelDescription">Description</label>
    <textarea id="editor" class="form-control" name="description" id="description" rows="3">{{ old('description', $product->description) }}</textarea>
</div>
<div class="form-group">
    <label for="variationStockLabel">Variation Stock ?</label>
    <button type="button" class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal"
        data-bs-target="#variationModal">Proceed</button>
    <div id="setVariation">

    </div>
    <div id="variationModal" class="modal variation_stock" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Stock Settings 
                        {{-- <button type="button" class="btn btn-sm btn-success" id="new_variation">New Variation</button> --}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="user_table">
                        <thead>
                         <tr>
                             <th width="35%">Variation Name</th>
                             <th width="35%">Stock</th>
                             <th width="35%">Price</th>
                             <th width="30%">Action</th>
                         </tr>
                        </thead>
                        <tbody id="variationTbody">
                            @if ($product->is_variation)
                                @foreach ($product->stocks as $stock)
                                    <tr>
                                        <td><input type="text" name="stock[{{ $stock->uuid }}][variation_name]" class="form-control variation-name" value="{{ $stock->name }}" required></td>
                                        <td><input type="number" name="stock[{{ $stock->uuid }}][quantity]" class="form-control variation-quantity" value="{{ $stock->quantity }}" required></td>
                                        <td><input type="number" name="stock[{{ $stock->uuid }}][price]" class="form-control variation-price" value="{{ $stock->price }}" required></td>
                                        <td>
                                            {{-- <button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button> --}}
                                            
                                            <button type="button" disabled name="remove" id="" class="btn btn-danger remove">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif                            
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" name="add_button_stock" id="add_button_stock" class="btn btn-primary">Add</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@if ($product->is_variation)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="quantityLabel">Stock</label>
                <input type="text" readonly class="form-control" name="quantity" id="quantity">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="priceLable">Price</label>
                <input type="text" readonly class="form-control" name="price" id="price">
            </div>
        </div>
    </div>
@else
    @foreach ($product->stocks as $stock)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="quantityLabel">Stock</label>
                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $stock->quantity) }}" id="quantity" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="priceLable">Price</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price', $stock->price) }}" id="price" required>
                </div>
            </div>
        </div>
    @endforeach
@endif
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="imaageLable">Images</label>
            <ul id="media-list" class="clearfix">
                @foreach ($product->product_images as $image)
                    <li>
                        <img src="{{ url('storage/' . $image->path_file) }}" alt="{{ $image->original_file_name }}" />
                        <div class="post-thumb">
                            <div class="inner-post-thumb">
                                {{-- @if ($product->product_images->count() > 2)
                                    <a href="javascript:void(0);" onclick="delete_image('{{ $image->uuid }}')" data-id="image-removebg-preview (3).png" data-route="{{ route('administrator.delete_image', $image->uuid) }}" class="remove-pic">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                @endif --}}
                                <div></div>
                            </div>
                        </div>
                    </li>
                @endforeach
                
                {{-- <li class="myupload">
                    <span><i class="fa fa-plus" aria-hidden="true"></i><input name="images[]" type="file" click-type="type2" id="picupload" class="picupload" multiple accept="image/png, image/gif, image/jpeg"></span>
                </li> --}}
            </ul>
        </div>
    </div>
</div>