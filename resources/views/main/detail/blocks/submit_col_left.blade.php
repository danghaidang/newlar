
<div class="big-left-col">
    <div class="left-col">
        <div class="t-counter">
            <p class="t-counter-num">{{$listStore['count']}}</p>
            <p>Coupons Available</p>
        </div>
        <div class="filter">
            <div class="h3">Filter by</div>
            <div class="l">
                <a class="filter-item" data-value="coupons" data-type="brand_type">
                    <span class="check"></span>
                    <div>Coupon Code (317)</div>
                </a>
                <a class="filter-item" data-value="deals" data-type="brand_type">
                    <span class="check"></span>
                    <div>Online Sales (5945)</div>
                </a>
                <a class="filter-item" data-value="percent_off" data-type="discount_type">
                    <span class="check"></span>
                    <div>% Off (1776)</div>
                </a>
                <a class="filter-item" data-value="price_off" data-type="discount_type">
                    <span class="check"></span>
                    <div><i>$</i> Off (846)</div>
                </a>
            </div>
        </div>
    </div>
    <div class="left-col">
        <div class="coupon-submit">
            <form class="coupon-submit-form">
                <div class="h3">
                    Submit a new coupon and help others save!
                </div>
                <div class="s-text">
                    Do you have more kohls.com coupon that we don't? Help other <span itemprop="name">kohls</span> shoppers by submitting your promo code here.
                </div>
                <input name="target_url" placeholder="From" value="kohls.com">
                <input name="locale" type="hidden" value="us">
                <input name="title" placeholder="title" value="">
                <div class="select-line">
                    <i class="down-angle"></i>
                    <input class="select" data-default="code" name="" readonly="" value="Coupon Code">
                    <input class="select-value" type="hidden" data-default="code" name="promotion_type" value="coupon">
                    <div class="options">
                        <div class="option" data-value="coupon">Coupon Code</div>
                        <div class="option" data-value="sale-deal">Sale/Shopping tips</div>
                    </div>
                </div>
                <input name="code" placeholder="code" maxlength="15">
                <textarea name="description" placeholder="description" maxlength="150"></textarea>
                <input name="expiration" class="time-select optional hasDatepicker" readonly="" placeholder="Expire (optional)" id="dp1521162019390">
                <button class="coupon-create-btn" type="submit">Submit This Coupon</button>
            </form>
        </div>

    </div>

</div>