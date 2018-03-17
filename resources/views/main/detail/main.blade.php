@extends('main.index')

@section('content_main')
    <div class="coupon" id="coupon-brand" data-brand="kohls.com" data-id="3940" data-slug="kohls-coupon" itemscope="" itemtype="http://schema.org/Store">
        <div class="c-ccontent-top">
            @include('main.detail.blocks.store_info')
        </div>


        <div class="coupon-wrap">
            <div class="coupon-store">
                <div class="m-c-w col-wrap">
                    @include('main.detail.blocks.submit_col_left')

                    <div class="main-col">
                        <div class="m-c-l">
                                <div class="c-r-list">
                                    @foreach($listCoupon as $items)
                                        @include('main.blocks.topoffer')
                                    @endforeach
                                </div>

                            <div class="e-c-l">
                                <div class="header">
                                    <h1>Expired Coupons</h1>
                                </div>
                                <div class="c-r-list">
                                    @include('main.detail.blocks.coupon_expired')
                                </div>
                             </div>


                            <div class="more-coupon">
                                <p>Showing <span class="size">50</span> of <span class="length">6229</span></p>
                                <button class="show-coupon-btn">Show Next <span class="next">50</span> Coupons</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection