<?php

namespace Modules\Page\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Internationalisation\BaseFormRequest;

class CreateShortUrlRequest extends FormRequest
{

    public function rules()
    {
        return [
            'description' => 'required',
            'redirect' => 'required',
        ];
    }


    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'template.required' => trans('page::messages.template is required'),
            'is_home.unique' => trans('page::messages.only one homepage allowed'),
        ];
    }

}
