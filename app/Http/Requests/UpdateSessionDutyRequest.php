<?php

namespace App\Http\Requests;

use App\Models\SessionDuty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSessionDutyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('session_duty_edit');
    }

    public function rules()
    {
        return [
            'session_id' => [
                'required',
                'integer',
            ],
            'section_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
