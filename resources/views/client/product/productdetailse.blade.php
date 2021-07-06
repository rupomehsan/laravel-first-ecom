@extends('layouts.index')
@push('custom-css')
    <style>
        .similarImage {
            width: 80px;
        }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endpush
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
             @include('partials.client.leftsite')
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{asset($product->image_1)}}" alt="" />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            
                              <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                      <a href=""><img src="{{asset($product->image_2)}}" height="50" width="90" alt=""></a>
                                      <a href=""><img src="{{asset($product->image_2)}}" height="50" width="90" alt=""></a>
                                      <a href=""><img src="{{asset($product->image_3)}}" height="50" width="90" alt=""></a>
                                    </div>
                                </div>

                              <!-- Controls -->
                              <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{$product->name}}</h2>
                            <p>Web ID: {{$product->code}}</p>
                            <img src="{{asset('client/images/product-details/rating.png')}}" alt="" />
                            <span>
                                <span>US ${{$product->price}}</span>
                                <label>Quantity:</label>
                                <input type="number" id="quantity" value="0" min="0" />
                                <button type="button" id="cartBtn" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> {{$product->brand->name}}</p>
                            <p><b>Category:</b> {{$product->category->name}}</p>
                            <p><b>Sub-Category:</b> {{$product->subcategory->name}}</p>
                            <a href=""><img src="{{asset('client/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
                 
                <div class="category-tab shop-details-tab "><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                          
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                            <li ><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="details" >
                         <p>{!!$product->description!!}</p>
                        </div>
                        
                       
                        
                        <div class="tab-pane fade" id="tag" >
                        <p>{{$product->tags}}</p>
                        </div>
                        
                        <div class="tab-pane fade  " id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>
                                
                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name"/>
                                        <input type="email" placeholder="Email Address"/>
                                    </span>
                                    <textarea name="" ></textarea>
                                    <b>Rating: </b> <img src="{{asset('client/images/product-details/rating.png')}}" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div><!--/category-tab-->      
            </div>
        </div>
    </div>
</section>
@endsection
@push('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>

    <script>
        $('#cartBtn').click(function() {
            var quantity = parseInt($('#quantity').val())
            var product_id = '{{ $product->id }}'
            var price = '{{ $product->price }}'

            if (!quantity) {
                toastr.error('Minimum 1 item required')
            } else {
                $.ajax({
                    url: '{{ route('carts.store') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'product_id': product_id,
                        'quantity': quantity,
                        'price': price
                    }, 
                    success: function(res) {
                        toastr.success(res.message)
                        $('#quantity').val(0)
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            }
        })

    </script>
@endpush