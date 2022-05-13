@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-7 col-md-8">
            <form method="post" id="form" action="/checkout">
                @csrf
                @if (count($items) > 0)
                @foreach ($items as $item)
                <input type="hidden" name="product_ids[]" value="{{$item['product_id']}}" />
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
                                                <div class="strike-through non-adjusted-price">
                                                    {{$item['regular_price']}}
                                                </div>
                                                <div class="pricing line-item-total-price-amount">
                                                    {{$item['sale_price']}}
                                                </div>
                                                <div class="qty-card-quantity-count" style="display:none">
                                                    1
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="line-item-promo">


                                    </div>

                                </div>
                                <div class="product-edit product-move">
                                <a href="#" class="remove-btn-lg remove-product" data-pid="1010586BJSAEO" data-action="/on/demandware.store/Sites-NTOSFRA-Site/default/Cart-RemoveProductLineItem" data-uuid="50ef52d6d9733f4a9ba05f526b" aria-label="Remove product Men's Retro Newberry Vest" title="Remove">🌸
                                    Remove(NOT WORK)
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="cart-products">
                    no item exists in the cart.
                </div>
                @endif

            </form>
        </div>
        <div class="col-sm-5 col-md-4">
            <div class="totals p-3">
                <h4 class="text-center">Order Summary</h4>

            </div>
            <!-- Sales Tax -->
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
<script>
    _etmc.push(["trackCart", {
        "cart": [{
            "item": "{{$item['id']}}",
            "quantity": "1",
            "price": "{{$item['regular_price']}}",
            "unique_id": "{{$item['id']}}" + "{{$timestamp}}",
        }]
    }]);
</script>

<script type="text/javascript">
    $(function() {

        // checkout 
        $("#checkoutButton").on("click", function(event) {
            _etmc.push(["trackConversion", {
                "cart": [{
                    "item": "{{$item['id']}}",
                    "quantity": "1",
                    "price": "{{$item['regular_price']}}",
                    "unique_id": "{{$item['id']}}" + "{{$timestamp}}",
                }]
            }]);

            event.preventDefault();
            let form = $("#form");
            form.submit();
        });

    });
</script>
@endsection