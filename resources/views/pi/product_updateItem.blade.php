<!-- resources/views/child.blade.phpとして保存 -->
@extends('layouts.app')
@section('content')
<div class="title m-b-md">
    Product_updateItem
</div>
<div class="m-b-md" id="itemId">
</div>
<div class="links">
</div>
<script type="text/javascript" src="//100033657.collect.igodigital.com/collect.js"></script>
<script>

  //日付から文字列に変換する関数
  function getStringFromDate(date) {

   var year_str = date.getFullYear();
   //月だけ+1すること
   var month_str = 1 + date.getMonth();
   var day_str = date.getDate();
   var hour_str = date.getHours();
   var minute_str = date.getMinutes();
   var second_str = date.getSeconds();

   format_str = 'YYYYMMDDhhmmss';
   format_str = format_str.replace(/YYYY/g, year_str);
   format_str = format_str.replace(/MM/g, month_str);
   format_str = format_str.replace(/DD/g, day_str);
   format_str = format_str.replace(/hh/g, hour_str);
   format_str = format_str.replace(/mm/g, minute_str);
   format_str = format_str.replace(/ss/g, second_str);

   return format_str;
  };
  var date = new Date();
  var rtn_str = getStringFromDate(date);


  _etmc.push(["setOrgId", "100033657"]);
  _etmc.push(["setUserInfo", {"email": "eihwan"}]);
  _etmc.push(["trackPageView"]);
  _etmc.push(["updateItem",
    {
      "item_type": "product",
      "item": "item" + rtn_str,
      "name": "item_product_code" + rtn_str,
      "url": "https://eihwan.com/product/" + rtn_str,
      "unique_id": "product_uniqid" +  + rtn_str,
      "available": "Y"
    }
  ]);
  $("#itemId").html("item" + rtn_str)
</script>

@endsection
