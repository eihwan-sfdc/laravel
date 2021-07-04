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
                <h2>ここも Recomenndation を出すように修正</h2>
            </div>
            <div class="igo_boxbody">
                <div class="igo_product"><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSW1BWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqSXdNakExTnpKK01TSXNJbklpT2pjek15d2ljSEFpT2pBc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5M2IyMWxiaVZGTWlVNE1DVTVPWE10Y21Wa0xXSnZlQzF3ZFd4c2IzWmxjaTFvYjI5a2FXVXRNakF5TURVM01rSklXQzVvZEcxc1AzTnZkWEpqWlQxcFoyOWthV2RwZEdGc0lpd2lkQ0k2SW5CeWIyUjFZM1JmY21Waklpd2ljRzRpT2lJeU1ERTFYMmh2YldVaWZRWTZCa1ZVLS0zZjkzMjJjYTIwMGRlNmU4MWYxNTU2Nzc5NGMxY2IzNjU3MGJhNTBhNmRmNmFkNzI3NTE1NjE0MmI0MGM1Mjhm"><img class="igo_product_image" src="https://production-internal-ccdemo.demandware.net/on/demandware.static/-/Sites-nto-apparel/default/dwcbecdeca/images/medium/2020572BHX-0.jpg"></a><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSW1BWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqSXdNakExTnpKK01TSXNJbklpT2pjek15d2ljSEFpT2pBc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5M2IyMWxiaVZGTWlVNE1DVTVPWE10Y21Wa0xXSnZlQzF3ZFd4c2IzWmxjaTFvYjI5a2FXVXRNakF5TURVM01rSklXQzVvZEcxc1AzTnZkWEpqWlQxcFoyOWthV2RwZEdGc0lpd2lkQ0k2SW5CeWIyUjFZM1JmY21Waklpd2ljRzRpT2lJeU1ERTFYMmh2YldVaWZRWTZCa1ZVLS0zZjkzMjJjYTIwMGRlNmU4MWYxNTU2Nzc5NGMxY2IzNjU3MGJhNTBhNmRmNmFkNzI3NTE1NjE0MmI0MGM1Mjhm">Women’s Red Box Pullover Hoodie</a>
                    <div class="igo_product_sale_price"><span class="igo_product_sale_price_label"></span><span class="igo_product_sale_price_value">$50.00</span></div>
                    <div class="igo_product_regular_price"><span class="igo_product_regular_price_label"></span><span class="igo_product_regular_price_value">$0.00</span></div>
                </div>
                <div class="igo_product"><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSWdBWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqRXdNakF4TnpGK01TSXNJbklpT2pjek15d2ljSEFpT2pFc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5dFpXNGxNamR6TFhOb2IzSjBMWE5zWldWMlpTMW9iM0pwZW05dUxYQnZiRzh0TVRBeU1ERTNNVUZET0M1b2RHMXNQM052ZFhKalpUMXBaMjlrYVdkcGRHRnNJaXdpZENJNkluQnliMlIxWTNSZmNtVmpJaXdpY0c0aU9pSXlNREUxWDJodmJXVWlmUVk2QmtWVS0tZTlmMWVlNGE3N2NmOGI5YWVlMzFiNWQwYzU5ODMxNDJjYzQ0Y2E0ODNlMjBlMGJkNWYwZmU1MTRiMjFhYjg2OQ=="><img class="igo_product_image" src="https://production-internal-ccdemo.demandware.net/on/demandware.static/-/Sites-nto-apparel/default/dw6473d0cd/images/medium/1020171AC8-0.jpg"></a><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSWdBWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqRXdNakF4TnpGK01TSXNJbklpT2pjek15d2ljSEFpT2pFc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5dFpXNGxNamR6TFhOb2IzSjBMWE5zWldWMlpTMW9iM0pwZW05dUxYQnZiRzh0TVRBeU1ERTNNVUZET0M1b2RHMXNQM052ZFhKalpUMXBaMjlrYVdkcGRHRnNJaXdpZENJNkluQnliMlIxWTNSZmNtVmpJaXdpY0c0aU9pSXlNREUxWDJodmJXVWlmUVk2QmtWVS0tZTlmMWVlNGE3N2NmOGI5YWVlMzFiNWQwYzU5ODMxNDJjYzQ0Y2E0ODNlMjBlMGJkNWYwZmU1MTRiMjFhYjg2OQ==">Men's Short-sleeve Horizon Polo</a>
                    <div class="igo_product_sale_price"><span class="igo_product_sale_price_label"></span><span class="igo_product_sale_price_value">$45.00</span></div>
                    <div class="igo_product_regular_price"><span class="igo_product_regular_price_label"></span><span class="igo_product_regular_price_value">$0.00</span></div>
                </div>
                <div class="igo_product"><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSWlBWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqRXdNakEwTURoK01TSXNJbklpT2pjek15d2ljSEFpT2pJc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5dFpXNGxNamR6TFhOb2IzSjBMWE5zWldWMlpTMXRiMjVoYm05amF5MXphR2x5ZEMweE1ESXdOREE0UWtoRkxtaDBiV3cvYzI5MWNtTmxQV2xuYjJScFoybDBZV3dpTENKMElqb2ljSEp2WkhWamRGOXlaV01pTENKd2JpSTZJakl3TVRWZmFHOXRaU0o5QmpvR1JWUT0tLWFhZjNmMzY2YjI5MTNhZTZmM2ZlOGM5MThlNGM3MWNjYmExZThlNDg2ZmMwODVhOWQzNDhmNDQ5OTM5NjU4YWI="><img class="igo_product_image" src="https://production-internal-ccdemo.demandware.net/on/demandware.static/-/Sites-nto-apparel/default/dw9bf195cd/images/medium/1020408BHE-0.jpg"></a><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSWlBWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqRXdNakEwTURoK01TSXNJbklpT2pjek15d2ljSEFpT2pJc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5dFpXNGxNamR6TFhOb2IzSjBMWE5zWldWMlpTMXRiMjVoYm05amF5MXphR2x5ZEMweE1ESXdOREE0UWtoRkxtaDBiV3cvYzI5MWNtTmxQV2xuYjJScFoybDBZV3dpTENKMElqb2ljSEp2WkhWamRGOXlaV01pTENKd2JpSTZJakl3TVRWZmFHOXRaU0o5QmpvR1JWUT0tLWFhZjNmMzY2YjI5MTNhZTZmM2ZlOGM5MThlNGM3MWNjYmExZThlNDg2ZmMwODVhOWQzNDhmNDQ5OTM5NjU4YWI=">Men's Short-sleeve Monanock Shirt</a>
                    <div class="igo_product_sale_price"><span class="igo_product_sale_price_label"></span><span class="igo_product_sale_price_value">$65.00</span></div>
                    <div class="igo_product_regular_price"><span class="igo_product_regular_price_label"></span><span class="igo_product_regular_price_value">$0.00</span></div>
                </div>
                <div class="igo_product last_rec"><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSWZBWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqRXdNakF5TlRGK01TSXNJbklpT2pjek15d2ljSEFpT2pNc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5dFpXNGxNamR6TFdOaGJYQm1hWEpsTFhCMWJHeHZkbVZ5TFdodmIyUnBaUzB4TURJd01qVXhRVlZFTG1oMGJXdy9jMjkxY21ObFBXbG5iMlJwWjJsMFlXd2lMQ0owSWpvaWNISnZaSFZqZEY5eVpXTWlMQ0p3YmlJNklqSXdNVFZmYUc5dFpTSjlCam9HUlZRPS0tNTA3NmNkNGIxODhmZWUwZjA3Yjc2MzUxNDlkMWIzYmVmMjk1MjUxNzg0MGQ1ZWUxZDI4NGE5M2E2NDYwNDUyZA=="><img class="igo_product_image" src="https://production-internal-ccdemo.demandware.net/on/demandware.static/-/Sites-nto-apparel/default/dwa1101bfe/images/medium/1020251AUD-0.jpg"></a><a href="https://nto.collect.igodigital.com/redirect/v3QkFoSklnSWZBWHNpYmlJNklrMXZjM1JRYjNCMWJHRnlJaXdpZFNJNklqRXdNakF5TlRGK01TSXNJbklpT2pjek15d2ljSEFpT2pNc0luSndJam94TENKcElqb2lNREF4WlRBeE5UVXpPRFppTlRsbFpXUmtaREF6WkRFeE9EWTRaR1EyWkRNaUxDSjNJam9pTWpBeE5VaHZiV1VpTENKc0lqb2lhSFIwY0hNNkx5OXdjbTlrZFdOMGFXOXVMV2x1ZEdWeWJtRnNMV05qWkdWdGJ5NWtaVzFoYm1SM1lYSmxMbTVsZEM5ekwwNVVUMU5HVWtFdlpHVm1ZWFZzZEM5dFpXNGxNamR6TFdOaGJYQm1hWEpsTFhCMWJHeHZkbVZ5TFdodmIyUnBaUzB4TURJd01qVXhRVlZFTG1oMGJXdy9jMjkxY21ObFBXbG5iMlJwWjJsMFlXd2lMQ0owSWpvaWNISnZaSFZqZEY5eVpXTWlMQ0p3YmlJNklqSXdNVFZmYUc5dFpTSjlCam9HUlZRPS0tNTA3NmNkNGIxODhmZWUwZjA3Yjc2MzUxNDlkMWIzYmVmMjk1MjUxNzg0MGQ1ZWUxZDI4NGE5M2E2NDYwNDUyZA==">Men's Campfire Pullover Hoodie</a>
                    <div class="igo_product_sale_price"><span class="igo_product_sale_price_label"></span><span class="igo_product_sale_price_value">$149.00</span></div>
                    <div class="igo_product_regular_price"><span class="igo_product_regular_price_label"></span><span class="igo_product_regular_price_value">$0.00</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@endsection