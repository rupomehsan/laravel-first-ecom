@extends('layouts.index')
@section('content')
<section id="advertisement">
    <div class="container">
        <img src="images/shop/advertisement.jpg" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
              @include('partials.client.leftsite')
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">All Products Items</h2>
                    @if (count($products))
                        @foreach ($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset($product->image_1)}}" alt="" />
                                        <h2>${{$product->price}}</h2>
                                        <p>{{$product->descripsion}}</p>
                                        <a href="{{url('/product-detailse',$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$product->price}}</h2>
                                            <p>{{$product->descripsion}}</p>
                                            <a href="{{url('/product-detailse',$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product detailse</a>
                                     </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        
                    @endif
                 
                  
                   
                </div>
                <ul class="pagination">
                    {{$products->links()}}
                 </ul><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection