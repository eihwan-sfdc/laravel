@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row home-categories">
        <div class="col-sm-4">
            <div class="category mens">
                <a href="/category/mens">
                    <span class="circle">
                        <span class="title">MENS</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="category womens">
                <a href="/category/womens">
                    <span class="circle">
                        <span class="title">WOMENS</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="category kids">
                <a href="/category/kids">
                    <span class="circle">
                        <span class="title">KIDS<br>(no data)</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="category gear">
                <a href="/category/gear">
                    <span class="circle">
                        <span class="title">GEAR<br>(no data)</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="category electronics">
                <a href="/category/electronics">
                    <span class="circle">
                        <span class="title">ELECTRONICS<br>(no data)</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="category energy-and-nutrition">
                <a href="/category/energy-and-nutrition">
                    <span class="circle">
                        <span class="title">ENERGY &amp; NUTRITION<br>(no data)</span>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="row recs">
        <div id="product_rec">
            <div class="igo_boxhead">
                <h2>PI Einstein Recommnedation Product</h2>
            </div>
            <div class="igo_boxbody">
                <div id="igdrec_1"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://{{config('app.MID')}}.recs.igodigital.com/a/v2/{{config('app.MID')}}/home/recommend.js" type="text/javascript"> </script>
@endsection

@section('javascript')
@endsection