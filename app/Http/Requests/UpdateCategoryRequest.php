<?php

namespace App\Http\Requests;

use App\Models\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('category_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:categories,title,' . request()->route('category')->id,
            ],
            'max_hours' => [
                'numeric',
                'required',
            ],
            'working_fn_from' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'working_fn_to' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'working_an_from' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'working_an_to' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
