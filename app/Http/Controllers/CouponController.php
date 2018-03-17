<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\Response;
use App\Store;
use App\Coupon;
use DateTime;


require_once app_path().'/libsimple/simple_html_dom.php';
class CouponController extends CouponFunctionController
{
    //
    public function getAdd() {
        $vars = [
            'data' => ''
        ];
       return view('coupon.home', $vars);
    }

    public function ajaxCoupon($store='', $page='') {
        $url = 'https://www.couponsatcheckout.net/' . $store;
        $data = file_get_html($url);//__DIR__.'/coupon.html');//$url);

       //print_r($data->find('.m-c-l',0)->find('.c-r-list .coupon-item'));exit;
        $result = [];
        $result[$store] = [
            'title' => $data->find('.c-t-center',0)->find('h4',0)->innertext,
            'logo' => $data->find('.c-t-logo',0)->find('img',0)->src,
            'count' => $data->find('.t-counter-num',0)->innertext,
            'used' => $data->find('.c-t-right', 0)->find('li',3)->innertext
        ];
        //insert store
        $storeExist =  Store::where('name', $store)->first();
        if(!$storeExist) $this->addStore($store, $result[$store]);

        $result[$store]['coupons'] = [];
        $result[$store]['expiredCoupon'] = [];
        /* coupon */
        $listCoupon = $data->find('.m-c-l',0);
        foreach($listCoupon->find('.c-r-list .coupon-item') as $items) {
            $its = [];
            $ie = $items->find('.off-info', 0);
            if(!empty($ie)) {
                $its['off'] = $items->find('.off-info', 0)->find('p', 0)->innertext;
                $its['verify'] = strpos($items->find('.verify-tag', 0)->innertext, 'Coupon Verified')?1:0;
                $its['used'] = $items->find('.use-count', 0)->innertext;
                $its['textoff'] = $items->find('.get-deal-btn', 0)->innertext;
                $getcode = $items->find('.operate', 0);
                $its['code'] = ($getcode->find('p',0))?$getcode->find('p',0)->innertext:$getcode->find('.get-deal-btn', 0)->href;
                $result[$store]['coupons'][] = $its;
            }
        }
        //insert coupon
        if(!$storeExist) $this->addCoupon($result[$store]['coupons']);
        /*coupon expired*/
        $listCoupon = $data->find('.m-c-l',0);
        foreach($listCoupon->find('.c-r-list .coupon-item') as $items) {
            $its = [];
            $ie = $items->find('.off-info', 0);
            if(!empty($ie)) {
                $its['off'] = $items->find('.off-info', 0)->find('p', 0)->innertext;
                $its['verify'] = strpos($items->find('.verify-tag', 0)->innertext, 'Coupon Verified')?1:0;
                $its['used'] = $items->find('.use-count', 0)->innertext;
                $its['textoff'] = $items->find('.get-deal-btn', 0)->innertext;

                $result[$store]['expiredCoupon'][] = $its;
            }
        }
        $listStore = $listCoupon = [];
        if($storeExist) {
            $listStore = Store::select('id','title','logo','count','name')->get()->toArray();
            $listCoupon = Coupon::select('id','off','verify','used','textoff','code')->get()->toArray();
        }
        return view('coupon.ajax', ['listStore' => $listStore, 'listCoupon' => $listCoupon]);
        //return response()->json($result)->header('Content-Type', 'application/json');

    }

    public function postAjaxCoupon(CouponRequest $rq, $store='', $page='') {
        return $this->ajaxCoupon($rq->url);
    }

    public function addStore($store, $dataInsert) {
        //store exists
            $tableStore = new Store;
            $tableStore->name = $store;
            foreach($dataInsert as $k=>$v) {
                $tableStore->{$k} = $v;
            }
            $tableStore->save();
    }

    public function addCoupon($listCoupon) {
        foreach($listCoupon as $vs) {
            $tableCoupon = new Coupon;
            foreach($vs as $k=>$v)
                $tableCoupon->{$k} = $v;
            $tableCoupon->save();
        }
    }


}
