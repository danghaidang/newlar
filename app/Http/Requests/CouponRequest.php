<?php

namespace App\Http\Requests;
use App\Http\Requests\request;

class CouponRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'url'   => 'required',
        ];
    }

    public function message() {
        return [
            'url.requered' => 'Yêu cầu nhập văn bản',
        ];
    }

}

