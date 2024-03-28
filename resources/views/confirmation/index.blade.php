@extends('layouts.app')

@section('content')
<div class="container">
    <h2>CHECKOUT COMPLETE</h2>

    ORDER NUMBER<br>
    <div class="order-number" data-orderid="{{$order_id}}" data-totalprice="{{$total_price}}">{{$order_id}}</div><br>

    @foreach ($items as $item)
                <div class="product-line-item">
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
                                                <div class="pricing line-item-total-price-amount">{{$item['sale_price']}}</div>
                                                
                                            </div>
                                            Quantity:&nbsp;<div class="qty-card-quantity-count" data-quantity="{{$item['quantity']}}">{{$item['quantity']}}</div>
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
                <div class="cart-products">
                    <div class="product-info-total  p-2 p-md-4">
                        <div class="row ">
                            <div class="col-12 col-md-7">
                            </div>
                            <div class="col-12 col-md-5 d-flex flex-column justify-content-between align-items-end product-card-footer">
                                <div class="d-none d-md-block">
                                    <div class="line-item-total-price">
                                        <div class="price">
                                            <div class="d-flex justify-content-end">
                                            Total Price : {{$total_price}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>

@endsection


@section('javascript')
<script language="javascript">
      //Set the following parameters for your conversion parameters
      var convid = "1";
      var displayorder = "1";
      var linkalias = "My Link Name";
      var dataset = "<data amt=\"1\" unit=\"Downloads\" accumulate=\"true\" />";
      //For additional datasets, simply add them to the concatenation:
      //dataset=dataset+"<data amt=\"500.00\" unit=\"Dollars\" accumulate=\"true\">
      //Do not change anything below
      function SetCookie(cookieName, cookieValue, nDays) {
         var today = new Date();
         var expire = new Date();
         if (nDays == null || nDays == 0) nDays = 1;
         expire.setTime(today.getTime() + 3600000 * 24 * nDays);
         document.cookie = cookieName + "=" + escape(cookieValue) + "; expires=" +
         expire.toGMTString() + "; path=/";
      }

      function getCookie(cookiename) {
         if (document.cookie.length > 0) {
            startC = document.cookie.indexOf(cookiename + "=");
         if (startC != -1) {
            startC += cookiename.length + 1;
            endC = document.cookie.indexOf(";", startC);
            if (endC == -1) endC = document.cookie.length;
            return unescape(document.cookie.substring(startC, endC));
         }
      }
      return null;
   }
   var jobid = getCookie("JobID");
   var emailaddr = getCookie("EmailAddr_");
   var subid = getCookie("SubscriberID");
   var listid = getCookie("ListID");
   var batchid = getCookie("BatchID");
   var urlid = getCookie("UrlID");
   var memberid = getCookie("MemberID");
   //Debug
   //document.write("<textarea rows=5 cols=80>");
      document.write("<img src='");
      document.write("https://click.exacttarget.com/conversion.aspx?xml=<system><system_name>tracking</system_name><action>conversion</action>");
      document.write("<member_id>" + memberid + "</member_id>");
      document.write("<job_id>" + jobid + "</job_id>");
      if (subid == undefined) {
      document.write("<sub_id></sub_id>");
      } else {
      document.write("<sub_id>" + subid + "</sub_id>");
      emailaddr = undefined;
      }
      if (emailaddr == undefined) {
      document.write("<email></email>");
      } else {
      document.write("<email>" + emailaddr + "</email>");
      }
      document.write("<list>" + listid + "</list>");
      document.write("<BatchID>" + batchid + "</BatchID>");
      document.write("<original_link_id>" + urlid + "</original_link_id>");
      document.write("<conversion_link_id>" + convid + "</conversion_link_id>");
      document.write("<link_alias>" + linkalias + "</link_alias>");
      document.write("<display_order>" + displayorder + "</display_order>");
      document.write("<data_set>" + dataset + "</data_set>");
      document.write("</system>'");
      document.write(" width='1' height='1'>");
   //Debug //document.write("</textarea>");
</script>
@endsection

