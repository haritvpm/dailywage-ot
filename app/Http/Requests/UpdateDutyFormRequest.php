<?php

namespace App\Http\Requests;

use App\Models\DutyForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDutyFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('duty_form_edit');
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
