<?php

namespace Modules\Services\Http\Requests\Services;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateServicesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title'=>'required|string|max:100',
            'description'=>'nullable|string|max:100',
            //'slug'=>'required|string|max:100',
            //'parent'=>'required',
            //'meta_title'=>'nullable|string|max:100',
            //'meta_description'=>'nullable|string|max:100',
            //'meta_keywords'=>'nullable|string|max:100',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
