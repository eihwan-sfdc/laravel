@extends('layouts.app')

@section('content')
<div class="container">
    <h2>WISHLIST</h2>
    <div class="row">
        <div class="col-sm-7 col-md-8">
            @csrf
            @if (count($items) > 0)
            @foreach ($items as $item)
            <!-- Wish List 商品一覧 LOOP START -->
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="removeButton" data-wishlist_id="{{$item['wishlist_id']}}" data-pid="{{$item['product_id']}}" title="Remove">
                            Remove
                        </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Wish List 商品一覧 LOOP END -->
            @endforeach
            @else
            <!-- Wish List 商品なし -->
            <div class="cart-products">
                no item exists in the wishlist.
            </div>
            @endif

            <!-- WishList の商品を削除する場合、こちらの form の hidden 項目に wishlist_id を設定して submit する処理を実行 (Javascript) -->
            <form method="post" id="form_wishlist_remove" action="/wishlist/delete">
                @csrf
                <input type="hidden" name="wishlist_id" id="form_wishlist_id_hidden">
            </form>
        </div>
        
        <iscontentasset aid="cart-help-content">
        </iscontentasset>
    </div>
</div>


@endsection




@section('javascript')

<script>
    
    $(function() {

        // WISHLIST REMOVE : 削除用 form_wishlist_id_hidden form 内 hidden 項目に a タグの data-wishlist_id attribute の値を設定後 Submit;
        $(".removeButton").on("click", function(event) {

            const wishlist_id = $(this).data('wishlist_id');
            event.preventDefault();
            $("#form_wishlist_id_hidden").val(wishlist_id);
            let form = $("#form_wishlist_remove");
            form.submit();
            
        });
    });
</script>

@endsection