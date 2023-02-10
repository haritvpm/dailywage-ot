<?php

namespace App\Http\Requests;

use App\Models\SingleDayDuty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSingleDayDutyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('single_day_duty_create');
    }

    public function rules()
    {
        return [
            'total_hours' => [
                'numeric',
            ],
            'section_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
