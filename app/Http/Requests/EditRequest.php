<?php

namespace App\Http\Requests;
use App\Http\Requests\request;

class EditRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'edit'   => 'required',
            'title' => 'required'
        ];
    }

    public function message() {
        return [
            'edit.requered' => 'Yêu cầu nhập văn bản',
            'title.unique' => 'Tiêu đề Bài viết đã tồn tại'
        ];
    }

}

