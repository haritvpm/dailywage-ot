<?php

namespace App\Http\Requests;

use App\Models\DutyFormItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDutyFormItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('duty_form_item_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'fn_from' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'fn_to' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'an_from' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'an_to' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'total_hours' => [
                'numeric',
            ],
        ];
    }
}
