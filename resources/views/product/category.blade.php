@extends('layouts.app')

@section('content')
<div class="container">
    <div class="recs">
        <div id="product_rec">
            <div class="igo_boxhead">
                <h2>DBから取得した製品</h2>
            </div>
            @foreach ($products as $item)
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
            @endforeach
        </div>
    </div>
</div>


@endsection