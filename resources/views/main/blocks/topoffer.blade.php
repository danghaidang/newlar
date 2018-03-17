
<div class="coupon-item c-r-item" data-value="1be927f6e8830b7b" data-slug="big-savings-with-wish-sale-section" itemscope="" itemprop="offers" itemtype="http://schema.org/Offer">
    <div class="wrap  sale">
        <div class="count">

            <div class="off">
                <div class="off-c">

                    <div class="off-img">


                        <img class="c-r-img" alt="wish promo codes" title="wish promo codes" src="{{ $items['c_r_img'] }}">

                    </div>

                </div>
                <div class="off-t">
                    Sale
                </div>
            </div>
        </div>
        <div class="info">
            @if($items['verified'])
            <div class="verify-tag"><i class="check-icon"></i>Coupon Verified</div>
            @endif
            <div class="use-tag"><span class="use-count">{{ $items['use_count'] }}</span> People Used Today</div>
            <a class="title get-deal-btn" rel="nofollow" href="{{ $items['get_deal_btn_href'] }}" itemprop="name" title="{{ $items['get_deal_btn_title'] }}">
                {{ $items['get_deal_btn_title'] }}
            </a>
            <div class="content">

                <div class="text p-content active" itemprop="description">
                    {{ $items['content_p'] }}



                </div>
            </div>
            <div class="extra">
                <div class="time-tip" itemprop="validThrough">
                    {{ $items['time_tip'] }}
                </div>
            </div>
            <div class="tool-line">
                <a class="thumb up-thumb  " data-value="1be927f6e8830b7b">
                    <i class="thumb-icon"></i>
                </a>
                <a class="thumb down-thumb  " data-value="1be927f6e8830b7b">
                    <i class="thumb-icon"></i>
                </a>

                <a class="r-p">
                    <span class="pct">{{ $items['pct'] }}</span>% of <span class="tl">{{ $items['tl'] }}</span> recommend
                </a>

                <a class="comment-btn"><i class="comment-icon"></i><span class="comment-count" data-value="1be927f6e8830b7b">{{ $items['comment_count'] }}</span></a>
            </div>
        </div>
        <div class="operate">

            @if($items['isgetdeal'])
                <a class="btn h-btn get-deal-btn" rel="nofollow" href="{{ $items['get_deal_btn_href'] }}"><p>{{ $items['code'] }}</p><span>Show Code</span></a>
            @else
                <a class="btn t-btn get-deal-btn" rel="nofollow" href="https://www.couponsatcheckout.net{{ $items['get_deal_btn_href'] }}">Get Deal</a>
            @endif

        </div>
    </div>
</div>