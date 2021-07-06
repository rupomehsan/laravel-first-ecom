@extends('layouts.index')
@push('custom-css')
    <style>
        .cart_product img {
            width: 90px;
        }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endpush
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" width="15%" >Item</td>
                        <td class="description" width="40%">Description</td>
                        <td class="price" width="10%">Price</td>
                        <td class="quantity" width="20%">Quantity</td>
                        <td class="total" width="10%">Total</td>
                        <td width="5%">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($carts))
                       @foreach ($carts as $cart)

                        <tr data-id={{ $cart->id }}>
                            <td class="cart_product">
                                <a href=""><img src="{{$cart->product->image_1}}" alt="" height="80" width="90"></a>
                            </td>
                            <td class="cart_description">
                                <h5>{!!$cart->product->description!!}</h5>
                            </td>
                            <td class="cart_price">
                                <p>${{$cart->price}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="javascript:void(0)"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                        value="{{ $cart->quantity }}" readonly autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="javascript:void(0)"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{(int)$cart->quantity * (float)$cart->price}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                       @endforeach 
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span id="subTotalPrice">$59</span></li>
                        <li>Eco Tax <span id="taxCost">$2</span></li>
                        <li>Shipping Cost <span id="shippingCost">$70</span></li>
                        <li>Total <span id="totalPrice">$61</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
@push('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>

    <script>
        function generateTotalPrice() {
            var cartTotalPriceItems = document.querySelectorAll('.cart_total_price');
            var taxCost = parseInt($('#taxCost').text().substr(1))
            var shippingCost = parseInt($('#shippingCost').text().substr(1))
            var subTotalPrice = 0;
            var totalPrice = 0

            cartTotalPriceItems.forEach(function(item) {
                var itemPrice = parseInt($(item).text().substr(1))
                subTotalPrice += itemPrice
            })

            totalPrice = subTotalPrice + taxCost + shippingCost

            $('#subTotalPrice').text('$' + subTotalPrice)
            $('#totalPrice').text('$' + totalPrice)
        }

        $(document).ready(function() {
            generateTotalPrice()
        })

        $('.cart_quantity_delete').click(function() {
            var selectedRow = $(this).parent().parent();
            var cartID = selectedRow.attr('data-id');

            $.ajax({
                url: '{{ url('carts') }}/' + cartID,
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'DELETE'
                },
                success: function(res) {
                    console.log(res)
                    if (res.status === 'done') {
                        toastr.success(res.message)
                        selectedRow.remove()
                        generateTotalPrice()
                    }
                },
                error: function(err) {
                    console.log(err)
                }
            })
        })

        $('.cart_quantity_up').click(function() {
            var parentId = $(this).parent().parent().parent().attr('data-id')
            var unitPrice = $(`[data-id=${parentId}] .cart_price p`)
            var totalPrice = $(`[data-id=${parentId}] .cart_total_price`)
            var inputField = $(`[data-id=${parentId}] .cart_quantity_input`)
            var inputFieldValue = inputField.val()
            var inputFieldNewValue = parseInt(inputFieldValue) + 1
            inputField.val(inputFieldNewValue)
            var formatUnitPrice = parseInt(unitPrice.text().substr(1))
            totalPrice.text('$' + (formatUnitPrice * inputFieldNewValue))

            $.ajax({
                url: '{{ url('carts') }}/' + parentId,
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'PATCH',
                    'quantity': 1
                },
                success: function(res) {
                    console.log(res)
                    if (res.status === 'done') {
                        toastr.success(res.message)
                        generateTotalPrice()
                    }
                }
            })
        })

        $('.cart_quantity_down').click(function() {
            var parentId = $(this).parent().parent().parent().attr('data-id')
            var unitPrice = $(`[data-id=${parentId}] .cart_price p`)
            var totalPrice = $(`[data-id=${parentId}] .cart_total_price`)
            var inputField = $(`[data-id=${parentId}] .cart_quantity_input`)
            var inputFieldValue = inputField.val()
            var inputFieldNewValue;
            var formatUnitPrice;

            if (parseInt(inputFieldValue) > 1) {
                inputFieldNewValue = parseInt(inputFieldValue) - 1
                inputField.val(inputFieldNewValue)
                formatUnitPrice = parseInt(unitPrice.text().substr(1))
                totalPrice.text('$' + (formatUnitPrice * inputFieldNewValue))

                $.ajax({
                    url: '{{ url('carts') }}/' + parentId,
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'PATCH',
                        'quantity': -1
                    },
                    success: function(res) {
                        console.log(res)
                        if (res.status === 'done') {
                            toastr.success(res.message)
                            generateTotalPrice()
                        }
                    }
                })
            }
        })
    </script>
@endpush