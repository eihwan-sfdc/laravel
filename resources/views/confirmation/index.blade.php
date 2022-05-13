@extends('layouts.app')

@section('content')
<div class="container">
    Checkout Complete (一覧はダミー)<br><br>

    ORDER NUMBER<br>
    <div class="order-number">
    {{$timestamp}}
    </div><br>

    <div class="row">
        <div class="col-sm-7 col-md-8">
            <div class="product-line-item">
                <div class="line-item-quantity-info" data-pid="1252100">
                <div class="pricing" data-pid="1252100">
                <div class="qty-card-quantity-count" data-pid="1252100">
            </div>
            <div class="product-line-item">
                <div class="line-item-quantity-info" data-pid="1255100">
                <div class="pricing" data-pid="1255100">
                <div class="qty-card-quantity-count" data-pid="1255100">
            </div>
            <div class="product-line-item">
                <div class="line-item-quantity-info" data-pid="1423100">
                <div class="pricing" data-pid="1423100">
                <div class="qty-card-quantity-count" data-pid="1423100">
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script type="text/javascript">
    
</script>
@endsection

