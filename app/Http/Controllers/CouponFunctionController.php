<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests\CouponRequest;
//use Illuminate\Http\Response;
use App\Store;
use App\Coupon;
use App\StorePage;

//use DateTime;


require_once app_path().'/libsimple/simple_html_dom.php';


class CouponFunctionController extends Controller {
//handle database
    public function addStore($store, $dataInsert) {
        //store exists
        if(!$this->storeExist($store)) {
            $tableStore = new Store;
            foreach ($dataInsert as $k => $v) {
                $tableStore->{$k} = $v;
            }
            $tableStore->save();
        }
    }

    public function addCoupon($listCoupon) {
        foreach($listCoupon as $vs) {
            if(!$this->couponExist($vs['storename'], $vs['code'])) {
                $tableCoupon = new Coupon;
                foreach ($vs as $k => $v) $tableCoupon->{$k} = $v;
                $tableCoupon->save();
            }
        }
    }
//handle store
    public function couponExist($store, $code) {
        return Coupon::where([
            ['storename','=',$store],
            ['code', '=', $code]
        ])->exists();
    }
    public function storeExist($store) {
        return Store::where('name', $store)->exists();
    }
    public function listCouponExist($store, $page=0, $size=50) {
        $pageloaded = StorePage::select('page')->where([
            ['name', '=', $store],
            ['page', '=', $page]
        ])->exists();
        return $pageloaded;
    }
    public function addPageLoaded($store, $page) {
        $pageExist = $this->listCouponExist($store, $page);
        if(!$pageExist) {
                $tableStore = new StorePage;
                $tableStore->name = $store;
                $tableStore->page = $page;
                $tableStore->save();
            }
    }

    public function getStoreName($domain) {
        preg_match('#https?://(.+)/?#', $domain, $preg);
        if(empty($preg)) return $domain;
        else {
            $preg = $preg[1];
            $result = explode('.', $preg);
            $index = count($result) - 2;
            $result = $result[$index];
            return $result;
        }
    }
//hande simple dom


}