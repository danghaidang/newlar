<?php

namespace App\Http\Requests;
use App\Http\Requests\request;

class AddRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'add'   => 'required',
            'title' => 'required|unique:lar_table,title'
        ];
    }

    public function message() {
        return [
            'add.requered' => 'Yêu cầu nhập văn bản',
            'title.unique' => 'Tên bài viết đã tồn tại'
        ];
    }

}

