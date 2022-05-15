@extends('layouts.app')

@section('content')
<div class="container">
    <h2>CHECKOUT COMPLETE</h2>

    ORDER NUMBER<br>
    <div class="order-number">
    {{$order_id}}
    </div><br>

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
                                            {{$item['name']}}
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
                                            <div class="qty-card-quantity-count" >
                                            Quantity:&nbsp;{{$item['quantity']}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="line-item-promo">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
</div>

@endsection


@section('javascript')
<script type="text/javascript">
    
</script>
@endsection

