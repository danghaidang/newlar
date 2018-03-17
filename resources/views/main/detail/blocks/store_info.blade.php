<!-- store info -->
<div class="m-c-w p-top">
    <div class="c-t-logo">
        <a href="{{ $listStore['linkurl'] }}" rel="nofollow" target="_blank">

            <div class="wrap">
                <div class="img-wrap">
                    <img class="brand-poster-img" itemprop="image" alt="kohls.com coupon" title="$site coupon" src="{{$listStore['logo']}}">
                </div>
            </div>

        </a>
    </div>
    <div class="c-t-center">
        <h4>{{$listStore['title']}}</h4>
        <div class="store-rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
            <div class="o-line">
                <div class="rating-stars">
                    <div class="star active" data-value="1" title="Poor"></div>
                    <div class="star active" data-value="2" title="Fair"></div>
                    <div class="star" data-value="3" title="Good"></div>
                    <div class="star" data-value="4" title="Very Good"></div>
                    <div class="star" data-value="5" title="Excellent"></div>
                </div>
                <span>Rate it!</span>
            </div>
            <div class="r-line">
                <span class="rating-record"><span class="rating-score" itemprop="ratingValue">{{$listStore['rate']}}</span> / <span class="rating-count" itemprop="reviewCount">{{$listStore['voted']}}</span> Voted</span>
                <meta itemprop="worstRating" content="0">
                <meta itemprop="bestRating" content="5">
                <span class="rating-result">

                        </span>
            </div>
        </div>
    </div>
    <div class="c-t-right">
        <ul>
            <li class="li-img"><i class="check-o-icon"></i></li>
            <li> verified coupons</li>
            <li class="li-margin"></li>
            <li>{{$listStore['used']}} used today</li>
        </ul>
        <a class="btn btn-o" rel="nofollow" target="_blank" href="{{$listStore['linkurl']}}">Visit Website</a>
    </div>
</div>
<!-- end store info -->