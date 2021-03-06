@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8">
            <!-- Product Images Carousel -->
            <div class="col carousel-container">
                <img src="{{ asset('images/product/')}}/{{$item['id']}}.jpg" class="img-fluid">
            </div>
        </div>

        <div class="pdp-primary-info col-12 col-md-4 col-xl-3">
            <!-- Product Name -->
            <div class="row">
                <div class="col">
                    <h1 class="product-name d-none d-md-block">{{$item['name']}}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col d-flex flex-wrap justify-content-between align-items-center pb-2">
                    <!-- Prices -->
                    <div class="prices">
                        <div class="price">
                            <span class="d-flex">
                                <span class="sales mr-1">
                                    <span class="value" content="100.00">
                                        {{$item['sale_price']}}$
                                    </span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="attributes">
                <div class="prices-add-to-cart-actions mt-sm-4">
                    <!-- Cart and [Optionally] Apple Pay -->
                    <div class="cart-and-ipay" data-ipay-enabled="true">
                        <div class="pdp-checkout-button d-flex">
                            <form method="post" action="" id="form">
                                @csrf
                                <input type="hidden" name="product_id" class="product-detail" value="{{$item['id']}}" 
                                data-pid="{{$item['id']}}" data-pname="{{$item['name']}}" data-category="{{$item['category']}}" 
                                data-regularprice="{{$item['regular_price']}}" data-saleprice="{{$item['sale_price']}}" data-gender="{{$item['gender']}}" >

                            </form>
                            <button type="submit" class="add-to-cart btn btn-primary flex-grow-1" id="addToCartButton">
                                <span class="ml-1">
                                    Add to Cart
                                </span>
                            </button>

                            <button type="submit" class="btn btn-primary add-to-wish-list ml-1" id="addToWishListButton">
                                ???????????????(???????????????)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="recs">
            <div id="product_rec">
                <div class="igo_boxhead">
                    <h2>????????? MC Einstein Recommendation</h2>
                </div>
                <div class="igo_boxbody">
                    <div class="igo_product">
                        
                    </div>
                </div>
                <div class="igo_boxhead">
                    <h2>????????? MC Evergage Recommendation</h2>
                </div>
                <div class="igo_boxbody">
                    <div class="evergage_product">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





@section('javascript')
<script>
    $(function() {

        // ??????????????????
        $("#addToCartButton").on("click", function(event) {
            event.preventDefault();
            let form = $("#form");
            form.attr("action", "/product/add_to_cart");
            form.submit();
        });

        // WhishList?????????
        $("#addToWishListButton").on("click", function(event) {
            event.preventDefault();
            let form = $("#form");
            form.attr("action", "/product/add_to_wishlist");
            form.submit();
        });

        _etmc.push(["trackPageView", { "item" : "{{$item['id']}}" }]);
    });
</script>
@endsection


