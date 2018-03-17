@foreach($listStore as $store)
<div class="row" id="store-info">
    <div class="col-3">
        <img width="150px" id="store-thumb" src="{{$store['logo']}}" />
    </div>
    <div class="col-6">
        <i></i>{{$store['name']}}</i><h4 id="title">{{$store['title']}}</h4><br/>
        Số lượng: <strong id="count">{{$store['count']}}</strong><br/>
        Used today: <strong id="used">{{$store['used']}}</strong><br/>
    </div>
</div>
@endforeach
<table class="table">
    <thead>
    <tr>
        <th>textoff</th>
        <th>off</th>
        <th>verify</th>
        <th>used</th>
        <th>code</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listCoupon as $coupon)
    <tr  class="coupon-items">
            : <td class="coupon-textoff">{{$coupon['textoff']}}</td>
            : <td class="coupon-off">{{$coupon['off']}}</td>
            : <td class="coupon-verify">{{$coupon['verify']?'verified':''}}</td>
            : <td class="coupon-used">{{$coupon['used']}}</td>
             : <td class="coupon-used">{{$coupon['code']}}</td>
    </tr>
    @endforeach
    </tbody>

<h4>Coupon Expired</h4>
<div class="row" id="expiredCoupon">

</div>