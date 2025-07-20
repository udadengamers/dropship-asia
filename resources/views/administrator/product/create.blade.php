<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('administrator.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Product Name
                                        <span class="text-danger required">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name"
                                        id="exampleFormControlInput1" placeholder="Product Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">SKU
                                        <span class="text-danger required">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="sku"
                                        id="exampleFormControlInput1" placeholder="Product SKU" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Categories
                                <span class="text-danger required">*</span>
                            </label>
                            <select class="form-control" id="exampleFormControlSelect1" name='categories' required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="labelDescription">Description
                                <span class="text-danger required">*</span>
                            </label>
                            <textarea id="editor" class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        {{-- <div class="form-group">
                            <textarea class="form-control" name="summernote" id="summernote"></textarea>
                        </div> --}}
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
                                            <h5 class="modal-title">Stock Settings <button type="button" class="btn btn-sm btn-success" id="new_variation">New Variation</button></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive"> 
                                                <table class="table table-bordered" id="user_table" style="min-width: 500px">
                                                    <thead>
                                                    <tr>
                                                        <th width="35%">Variation Name
                                                            <span class="text-danger required">*</span>
                                                        </th>
                                                        <th width="35%">Stock
                                                            <span class="text-danger required">*</span>
                                                        </th>
                                                        <th width="35%">Price
                                                            <span class="text-danger required">*</span>
                                                        </th>
                                                        <th width="30%">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="variationTbody"></tbody>
                                                    <tfoot></tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" name="add_button_stock" id="add_button_stock" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantityLabel">Stock
                                        <span class="text-danger required">*</span>
                                    </label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" required min="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priceLable">Price
                                        <span class="text-danger required">*</span>
                                    </label>
                                    <input type="number" class="form-control" name="price" id="price" required step=".001" min="0.1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="imaageLable">Images
                                        <span class="text-danger required">*</span>
                                    </label>
                                    <ul id="media-list" class="clearfix">
                                        <li class="myupload">
                                            <span><i class="fa fa-plus" aria-hidden="true"></i><input name="images[]" type="file" click-type="type2" id="picupload" required class="picupload" multiple accept="image/png, image/gif, image/jpeg"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button id="submit-button" type="submit" class="btn btn-primary mb-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            
            var count = 1;

            $("#submit-button").click(function() {
                var valid = true;
                body = $('#variationTbody tr');
                if (body.length > 0) {
                    input = $('#variationTbody input');
                    $.each(input, function(index, item) {
                        if (item.min && (item.value < item.min)) {
                            $('#variationModal').modal('show');
                        }
                        if (item.step && (item.value < item.step)) {
                            $('#variationModal').modal('show');
                        }
                        if (item.value == '') {
                            $('#variationModal').modal('show');
                        }
                    });
                    var values = $('.variation-name').map(function() {
                        return $(this).val();
                    }).get();
                    var uniqueValues = [...new Set(values)];
                    if (values.length !== uniqueValues.length) {
                        alert('duplicate variant name')
                        valid = false;
                        $('.variation-name').css("border-color", "red");
                        $('#variationModal').modal('show');
                    }
                }
                return valid;
            });

            function dynamic_field(number)
            {
                html = '<tr>';
                html += '<td><input type="text" name="stock['+number+'][variation_name]" class="form-control variation-name" required/></td>';
                html += '<td><input type="number" name="stock['+number+'][quantity]" class="form-control variation-quantity" required min="1"/></td>';
                html += '<td><input type="number" name="stock['+number+'][price]" class="form-control variation-price" required step=".001" min="0.1"/></td>';

                if (number > 1) {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                }
            }

            $(document).on('click', '#new_variation', function(){
                count++;
                dynamic_field(count);
                update_stock('new_stock');
            });

            $('#variationModal').on('hidden.bs.modal', function () {
                update_stock('add_button_stock');
            });

            $(document).on('click', '.remove', function(){
                count--;
                $(this).closest("tr").remove();
                update_stock('remove');
                body = $('#variationTbody tr');
                if (body.length < 1) {
                    $("#quantity").prop({"type": "number", "value": '', "readonly": false, "min": 1});
                    $("#price").prop({"type": "number", "value": '', "readonly": false, "min": 0.1, "step": 0.1});
                }
            });

            $(document).on('click', '#add_button_stock', function(){
                update_stock('add_button_stock');
            });

            function update_stock(type) {
                body = $('#variationTbody tr');
                total_quantity = 0;
                smallest_price = 0;
                highest_price = 0;
                result = 0;
                if (body.length > 0) {
                    input = $('#variationTbody input');
                    if ((type == 'add_button_stock') || (type == 'remove')) {
                        $.each(input, function(index, item) {
                            if (item.value == '') {
                                alert('Stocks Setting cannot be null.')
                                return false;
                            }
                            if ($(this).attr('class').split(' ').pop() == 'variation-quantity') {
                                total_quantity += parseInt(item.value);
                            }
                            if ($(this).attr('class').split(' ').pop() == 'variation-price') {
                                if (index == 2) {
                                    smallest_price = parseInt(item.value);
                                    highest_price = parseInt(item.value);
                                } else {
                                    if (smallest_price > parseInt(item.value)) {
                                        smallest_price = parseInt(item.value);
                                    }
                                    if (highest_price < parseInt(item.value)) {
                                        highest_price = parseInt(item.value);
                                    }
                                }
                            }
                        });
                    }
                    if (smallest_price == highest_price) {
                        result = smallest_price;
                    } else {
                        result = smallest_price + ' - ' + highest_price;
                    }
                    $("#quantity").prop({"type": "text", "value": total_quantity, "readonly": true});
                    $("#price").prop({"type": "text", "value": result, "readonly": true});
                }
            }
        </script>
    @endpush
</x-admin.auth-layout>
