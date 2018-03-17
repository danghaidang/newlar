<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests\CouponRequest;
//use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use App\Store;
use App\Coupon;
//use DateTime;


require_once app_path().'/libsimple/simple_html_dom.php';
class HomeCouponController extends CouponFunctionController
{
    public function getHome() {
        $url = 'https://www.couponsatcheckout.net/';
        $data = file_get_html($url);

        //recomended top
        $recomendedTop = $data->find('.t-s-l', 0);
        $dataRecomended = [];
        foreach($recomendedTop->find('.t-s-i') as $items) {
            $get = [];
            $get['urlSiteCoupon'] = $items->find('a',0)->href;
            $get['mylinkStore'] = route('getDetail', ['store' => $this->getStoreName($get['urlSiteCoupon']).'-coupon']);
            $get['top'] = strpos($items->class,'top');
            $get['img-wrap'] = [];
            foreach($items->find('.img') as $img) {
                $get['img-wrap'][] = [$img->find('img',0)->src, strpos($img->class, 'pst')];
            }
            $dataRecomended[] = $get;

        }
        //top offer
        $topOffer = $data->find('.c-r-list', 0);
        $dataTopOffer = [];
        foreach($topOffer->find('.coupon-item') as $items) {
           // dd($items->find('.pct', 0)->innertext);exit;
            $get = [];
            $get['c_r_img'] = $items->find('.c-r-img',0)->src;
            $get['verified'] = $items->find('.check-icon', 0)?1:0;
            $get['use_count'] = $items->find('.use-count',0)->innertext;
            $getdeal = $items->find('.get-deal-btn',0);
            $get['get_deal_btn_href'] = $getdeal->href;
            $get['storename'] = $this->getStoreName($getdeal->href);
            //$this->getDetail($storeName); //auto get first list coupon of store and insert to database
            $get['get_deal_btn_title'] = $getdeal->innertext;

            $content = $items->find('.content', 0);
            $get['content_p'] = $content->find('.p-content',0)->innertext;
            $get['time_tip'] = $items->find('.time-tip', 0)->innertext;
            $get['comment_count'] = $items->find('.comment-count',0)->innertext;

            $getcode = $items->find('.operate', 0);
            $isdealcode = $getcode->find('p',0);
            $get['code'] = ($isdealcode)?$getcode->find('p',0)->innertext:$getcode->find('.get-deal-btn', 0)->href;
            $get['isgetdeal'] = $isdealcode?1:0;

            $get['pct'] = $items->find('.pct', 0)?$items->find('.pct', 0)->innertext:'';//maybe none
            $get['tl'] = $items->find('.tl', 0)?$items->find('.tl', 0)->innertext:'';//maybe none
            $get['expire'] = 1;

            $dataTopOffer[] = $get;
        }

        $vars = ['dataRecomended' => $dataRecomended, 'dataTopOffer' => $dataTopOffer];
        return view('main.home', $vars);
    }

    public function getDetail($store='') {
        $storeExist =  Store::where('name', $store)->first();
        if(!$storeExist) {
            $url = 'https://www.couponsatcheckout.net/' . $store;
            $data = file_get_html($url);//__DIR__.'/coupon.html');//$url);
            $result = [];
            $result[$store] = [];
            $result[$store]['info'] = $this->getStoreInfo($data, $store);
            $result[$store]['coupons'] = $this->getListCoupon($data, $store);
        }
        /*coupon expired*/
        if(!$storeExist) {
            $listCoupon = $data->find('.m-c-l', 0);
            if ($listCoupon) foreach ($listCoupon->find('.c-r-list .coupon-item') as $items) {
                $its = [];
                $ie = $items->find('.off-info', 0);
                if (!empty($ie)) {
                    $its['off'] = $items->find('.off-info', 0)->find('p', 0)->innertext;
                    $its['verify'] = $items->find('.verify-tag', 0) && strpos($items->find('.verify-tag', 0)->innertext, 'Coupon Verified') ? 1 : 0;
                    $its['used'] = $items->find('.use-count', 0)->innertext;
                    $its['textoff'] = $items->find('.get-deal-btn', 0)->innertext;

                    $result[$store]['expiredCoupon'][] = $its;
                }
            }
        }

        $limit = 50;
        if(Store::where('name', $store)->first()) {
            $store_info = Store::all()->where('name', $store)->toArray()[0];
            $listCoupon = Coupon::where('storename', $store)->paginate($limit);
        }else {
            $store_info = $result[$store]['info'];
            $listCoupon = $result[$store]['coupons'];
        }
        return view('main.detail.main', ['listStore' => $store_info, 'listCoupon' => $listCoupon]);
        //return response()->json($result)->header('Content-Type', 'application/json');

    }


    public function couponPage($store, $page, $size=50) {
        if(!$this->storeExist($store)) {
            $url = 'https://www.couponsatcheckout.net/' . $store;
            $data = file_get_html($url);
            $this->getStoreInfo($data, $store);
        }


            $url = "https://www.couponsatcheckout.net/kohls-coupon/ajax/?page=$page&page_size=$size";
            $data = file_get_html($url);
            $result = $this->getListCoupon($data,
                $store,
                $defaultClass = ['parent'=>'.coupon-list', 'expire'=>'.expire-list']
            );
        //$listStore = $listCoupon = [];
        if(Store::where('name', $store)->first()) {
            $listCoupon = Coupon::where('storename', $store)->paginate($size);
        }else {
            $listCoupon = $result[$store]['coupons'];
        }
        return view('main.ajax.getpage', ['listCoupon' => $listCoupon]);
    }

    public function getStoreInfo($data, $store) {
        $storeExist =  Store::where('name', $store)->first();
        //print_r($data->find('.m-c-l',0)->find('.c-r-list .coupon-item'));exit;
        $result = [];
        $result[$store]['info'] = [];
        $result[$store]['info'] = [
            'title' => $data->find('.c-t-center',0)->find('h4',0)->innertext,
            'logo' => $data->find('.c-t-logo',0)->find('img',0)->src,
            'count' => $data->find('.t-counter-num',0)->innertext,
            'name' => $store,
            'used' => $data->find('.c-t-right', 0)->find('li',3)->innertext,
            'linkurl' => 'https://www.couponsatcheckout.net'.$data->find('.c-t-logo', 0)->find('a',0)->href,
            'rate' => $data->find('.rating-score',0)->innertext,
            'voted' => $data->find('.rating-count',0)->innertext
        ];
        $store_info = $result[$store]['info'];
        //insert store
        if(!$storeExist) $this->addStore($store, $result[$store]['info']);
        return $store_info;
    }

    public function getListCoupon(
        $data,
        $store,
        $defaultClass = ['parent'=>'.m-c-l', 'expire'=>'.c-r-list'])
    {

        $result = []; $result[$store] = [];
        $result[$store]['coupons'] = [];
        $result[$store]['expiredCoupon'] = [];
        /* coupon */
        $listCoupon = $data->find($defaultClass['parent'],0);
        foreach($listCoupon->find("{$defaultClass['expire']} .coupon-item") as $items) {
            $its = [];
            $ie = $items->find('.off-info', 0);
            if(!empty($ie)) {
                //add more
                $its['c_r_img'] = $items->find('.c-r-img',0)->src;
                $its['verified'] = $items->find('.check-icon', 0)?1:0;
                $its['use_count'] = $items->find('.use-count',0)->innertext;
                $getdeal = $items->find('.get-deal-btn',0);
                $its['get_deal_btn_href'] = $getdeal->href;
                $its['storename'] = $store;//$this->getStoreName($getdeal->href);
                $its['get_deal_btn_title'] = $getdeal->innertext;

                $content = $items->find('.content', 0);
                $its['content_p'] = $content->find('.p-content',0)->innertext;
                $its['time_tip'] = $items->find('.time-tip', 0)->innertext;
                $its['comment_count'] = $items->find('.comment-count',0)->innertext;

                $getcode = $items->find('.operate', 0);
                $isdealcode = $getcode->find('p',0);
                $its['code'] = ($isdealcode)?$getcode->find('p',0)->innertext:$getcode->find('.get-deal-btn', 0)->href;
                $its['isgetdeal'] = $isdealcode?1:0;

                $its['pct'] = $items->find('.pct', 0)?$items->find('.pct', 0)->innertext:'';//maybe none
                $its['tl'] = $items->find('.tl', 0)?$items->find('.tl', 0)->innertext:'';//maybe none
                $its['expire'] = 1;// 1 con han 0 hen han

                $result[$store]['coupons'][] = $its;

            }
        }
        //insert coupon
            $this->addCoupon($result[$store]['coupons']);

        return $result;
    }


}
