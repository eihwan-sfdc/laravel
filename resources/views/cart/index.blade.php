@extends('layouts.app')

@section('content')
<div class="container">
    <h2>CART</h2>
    <div class="row">
        <div class="col-sm-7 col-md-8">
            <form method="post" id="form" action="/checkout">
                @csrf
                @if (count($items) > 0)
                @foreach ($items as $item)
                <!-- カート商品一覧 LOOP START -->
                <input type="hidden" name="product_ids[]" value="{{$item['product_id']}}" />
                <input type="hidden" name="quantities[]" value="{{$item['quantity']}}" />
                <div class="cart-products">
                    <div class="product-info  p-2 p-md-4">
                        <div class="row ">
                            <div class="col-12 col-md-7">
                                <div class="d-flex flex-row">
                                    <div class="item-image">
                                        <a href="/detail/{{$item['id']}}">
                                            <img class="product-image" src="{{ asset('images/product/')}}/{{$item['id']}}.jpg">
                                        </a>
                                    </div>
                                    <div class="product-details">
                                        <div class="line-item-header">
                                            <div class="line-item-name" data-pid="{{$item['id']}}" data-price="{{$item['sale_price']}}">
                                                <a href="/detail/{{$item['id']}}" class="d-inline-block text-reset text-truncate">{{$item['name']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 d-flex flex-column justify-content-between align-items-end product-card-footer">
                                <div class="d-none d-md-block">
                                    <div class="line-item-total-price">
                                        <div class="price">
                                            <div class="d-flex justify-content-end">
                                            Price:&nbsp;<div class="strike-through non-adjusted-price">
                                                    {{$item['regular_price']}}
                                                </div>
                                                <div class="pricing line-item-total-price-amount">
                                                    {{$item['sale_price']}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="qty-card-quantity-count">
                                            Quantity:&nbsp;<span>{{$item['quantity']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="removeButton" data-cart_id="{{$item['cart_id']}}" data-pid="{{$item['product_id']}}" title="Remove">
                                    Remove
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- カート商品一覧 LOOP END -->
                @else
                <!-- カート商品がばい場合 -->
                <div class="cart-products">
                    no item exists in the cart.
                </div>
                @endif
            </form>
            <!-- カートの商品を削除する場合、こちらの form の hidden 項目に cart_id を設定して submit する処理を実行 (Javascript) -->
            <form method="post" id="form_cart_remove" action="/cart/delete">
                @csrf
                <input type="hidden" name="cart_id" id="form_cart_id_hidden">
            </form>
        </div>
        <!-- 画面右側 Summary 部分 -->
        <div class="col-sm-5 col-md-4">
            <div class="totals p-3">
                <h4 class="text-center">Order Summary</h4>

            </div>
            <div class="row mb-2">
                <div class="col-8">
                    <div>Sales Tax</div>
                </div>
                <div class="col-4">
                    <div class="text-right tax-total">{{$tax}}</div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-8">
                    <strong>Estimated Total</strong>
                </div>
                <div class="col-4">
                    <div class="text-right grand-total">{{$total_price + $tax}}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 checkout-continue">
                    <div class="checkout-and-applepay d-flex align-content-between">
                        <a href="javascript:void(0);" class="btn btn-primary checkout-btn " role="button" id="checkoutButton">
                            Checkout
                        </a>
                        <isapplepay class="apple-pay-cart"></isapplepay>
                    </div>

                </div>
            </div>
        </div>
        <iscontentasset aid="cart-help-content">
        </iscontentasset>
    </div>
</div>


@endsection



@section('javascript')
<!-- カート item が存在しない場合エラーにならないよう items が 0件以上の場合のみ描画-->
@if (count($items) > 0)
<script>

    // 下記は trackCart は PI 用に適当に書いたものなので、PIに興味ある方はぜひ修正を! 
    // _etmc.push(["trackCart", {
    //     "cart": [{
    //         "item": "{{$item['id']}}",
    //         "quantity": "1",
    //         "price": "{{$item['regular_price']}}",
    //         "unique_id": "{{$item['id']}}" + "{{$timestamp}}",
    //     }]
    // }]);

    $(function() {

        // checkout 
        $("#checkoutButton").on("click", function(event) {

            // 下記 trackConversion は PI 用に適当に書いたものなので、PIに興味ある方はぜひ修正を! 
            // _etmc.push(["trackConversion", {
            //     "cart": [{
            //         "item": "{{$item['id']}}",
            //         "quantity": "1",
            //         "price": "{{$item['regular_price']}}",
            //         "unique_id": "{{$item['id']}}" + "{{$timestamp}}",
            //     }]
            // }]);

            event.preventDefault();
            let form = $("#form");
            form.submit();
        });

        // カート REMOVE : 削除用 form_cart_id_hidden form 内 hidden 項目に a タグの data-cart_id attribute の値を設定後 Submit;
        $(".removeButton").on("click", function(event) {
            const cart_id = $(this).data('cart_id');

            event.preventDefault();
            $("#form_cart_id_hidden").val(cart_id);
            let form = $("#form_cart_remove");
            form.submit();
        });
    });

</script>
@endif
@endsection