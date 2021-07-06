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
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="radio" id="account" name="account" value="register"> Register Account</label>
                </li>
                <li>
                    <label><input type="radio" id="account" name="account" value="guest"> Guest Checkout</label>
                </li>
                {{-- <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li> --}}
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                {{-- <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="Display Name">
                            <input type="text" placeholder="User Name">
                            <input type="password" placeholder="Password">
                            <input type="password" placeholder="Confirm password">
                        </form>
                        <a class="btn btn-primary" href="">Get Quotes</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div> --}}
                <div class="col-sm-8 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form>
                                {{-- <input type="text" placeholder="Company Name"> --}}
                               
                                {{-- <input type="text" placeholder="Title"> --}}
                                <input id="first_name" type="text" placeholder="Full Name *">
                                <input type="text" placeholder="Email*">
                                {{-- <input type="text" placeholder="Middle Name"> --}}
                                {{-- <input id="last_name" type="text" placeholder="Last Name *"> --}}
                                <input id="phone" type="text" placeholder="Phone *">
                                <input id="address_1" type="text" placeholder="Address  *">
                                {{-- <input id="address_2" type="text" placeholder="Address 2"> --}}
                            </form>
                        </div>
                        <div class="form-two">
                            <form>
                                {{-- <input id="post_code" type="text" placeholder="Zip / Postal Code *"> --}}
                                <select id="division_id">
                                    <option selected disabled>-- Division --</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                                <select id="district_id">
                                    <option selected disabled>-- District --</option>
                                </select>
                                <select id="station_id">
                                    <option selected disabled>-- Stations --</option>
                                </select>
                                {{-- <input type="password" placeholder="Confirm password"> --}}
                             
                                {{-- <input type="text" placeholder="Mobile Phone"> --}}
                                {{-- <input type="text" placeholder="Fax"> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>	
                </div>					
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
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
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td colspan="4">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td id="subTotalPrice">$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td id="taxCost">$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td id="shippingCost">$70</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span id="totalPrice">$61</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

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

            $('#division_id').change(function(e) {
                var division_id = $(this).val()

                $.ajax({
                    method: 'get',
                    url: '{{ url('api/districts') }}/' + division_id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res)

                        $('#district_id').empty()
                        $('#district_id').append(
                            "<option disabled selected>Select Sub Category</option>")
                        res.districts.forEach(function(item) {
                            $('#district_id').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })


            $('#district_id').change(function(e) {
                var district_id = $(this).val()

                $.ajax({
                    method: 'get',
                    url: '{{ url('api/stations') }}/' + district_id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res)

                        $('#station_id').empty()
                        $('#station_id').append(
                            "<option disabled selected>Select Sub Category</option>")
                        res.stations.forEach(function(item) {
                            $('#station_id').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })

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