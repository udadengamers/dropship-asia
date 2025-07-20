<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    </div>
    <section class="card">
        <div class="card-body">
            <form action="{{ route('administrator.product.update', $product->uuid) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                @include('administrator.product.parts.form', $product)
                <button id="submit-button" class="btn btn-success" type="submit">Update</button>
            </form>
        </div>
    </section>
    @push('after-scripts')
        <script>
            $("#submit-button").click(function() {
                body = $('#variationTbody tr');
                var valid = true;
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

            $( document ).ready(function() {
                update_stock('add_button_stock');
            });

            $('#variationModal').on('hidden.bs.modal', function () {
                update_stock('add_button_stock');
            });

            var count = {!! json_encode($product->is_variation ? ($product->stocks->count()+1) : 1) !!};

            function dynamic_field(number)
            {
                html = '<tr>';
                html += '<td><input type="text" name="stock['+number+'][variation_name]" class="form-control variation-name" required/></td>';
                html += '<td><input type="number" name="stock['+number+'][quantity]" class="form-control variation-quantity" required min="1"/></td>';
                html += '<td><input type="number" name="stock['+number+'][price]" class="form-control variation-price" required step="0.1" min="0.1"/></td>';

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
                value = true;
                if (body.length > 0) {
                    input = $('#variationTbody input');
                    if ((type == 'add_button_stock') || (type == 'remove')) {
                        $.each(input, function(index, item) {
                            if (item.value == '') {
                                alert('Stocks Setting cannot be null.')
                                value = false;
                                return false;
                            } else {
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
                            }
                        });
                        
                        if (smallest_price == highest_price) {
                                result = smallest_price;
                            } else {
                                result = smallest_price + ' - ' + highest_price;
                            }
                            $("#quantity").prop({"type": "text", "value": total_quantity, "readonly": true});
                            $("#price").prop({"type": "text", "value": result, "readonly": true});
                        }
                }
            }
            
            function delete_image(uuid) {
                console.log('sad')
                let token   = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: `/superuseradminlacj5ub3lqwysaj9rik5/delete-image/${uuid}`,
                    type: "DELETE",
                    cache: false,
                    data: {
                        _token: token,
                        _method: 'DELETE'
                    },
                    success:function(response){ 
                        console.log(response)
                        if (!response.status) {
                            if (confirm('The minimum number of images allowed is 1.')){
                                window.location.reload();  
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
</x-admin.auth-layout>
