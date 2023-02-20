@extends('layouts.app')

@section('content')
<div class="container">
    <h2>STATIC</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/static/page-a">
                {{ __('PAGE-A') }}
            </a><br><br>
            <a href="/static/page-b">
                {{ __('PAGE-B') }}
            </a><br><br>
            <a href="/static/page-c">
                {{ __('PAGE-C') }}
            </a><br><br>
        </div>
    </div>
</div>
@endsection
