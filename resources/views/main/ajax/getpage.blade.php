<div class="coupon-list">
    <div class="expire-list">
        @foreach($listCoupon as $items)
            @include('main.blocks.topoffer')
        @endforeach
    </div>


    <div class="expired-list">
    </div>
</div>