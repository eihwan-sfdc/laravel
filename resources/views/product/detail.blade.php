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
                                <input type="hidden" name="product_id" value="{{$item['id']}}">
                            </form>
                            <button type="submit" class="add-to-cart btn btn-primary flex-grow-1" data-pid="1050279A1T" id="addToCartButton">
                                <span class="ml-1">
                                    Add to Cart
                                </span>
                            </button>

                            <button type="submit" class="btn btn-primary add-to-wish-list ml-1" id="addToWishListButton">
                                お気に入り(動作しない)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="recs">
            <div id="product_rec">
                <div class="igo_boxhead">
                    <h2>ここは今後レコメンド製品を出す</h2>
                </div>
                <div class="igo_boxbody">
                    <div class="igo_product">
                        <a href="/detail/{{$item['id']}}">
                            <img class="igo_product_image" src="{{ asset('images/product/')}}/{{$item['id']}}.jpg">
                        </a>
                        <a href="/detail/{{$item['id']}}">
                            {{$item['name']}}
                        </a>
                        <div class="igo_product_sale_price"><span class="igo_product_sale_price_label"></span><span class="igo_product_sale_price_value">{{$item['regular_price']}}$</span></div>
                        <div class="igo_product_regular_price"><span class="igo_product_regular_price_label"></span><span class="igo_product_regular_price_value">{{$item['sale_price']}}$</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





@section('javascript')
<script type="text/javascript">
    $(function() {

        // カートへ追加
        $("#addToCartButton").on("click", function(event) {
            event.preventDefault();
            let form = $("#form");
            form.attr("action", "/product/add_to_cart");
            form.submit();
        });

        // WhishListへ追加
        $("#addToWishListButton").on("click", function(event) {
            event.preventDefault();
            let form = $("#form");
            form.attr("action", "/product/add_to_wishlist");
            form.submit();
        });
    });
</script>
@endsection


