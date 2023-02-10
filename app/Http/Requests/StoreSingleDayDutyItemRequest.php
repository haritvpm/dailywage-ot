<?php

namespace App\Http\Requests;

use App\Models\SingleDayDutyItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSingleDayDutyItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('single_day_duty_item_create');
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
