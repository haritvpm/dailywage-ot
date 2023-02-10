<?php

namespace App\Http\Requests;

use App\Models\SessionDutyItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSessionDutyItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('session_duty_item_edit');
    }

    public function rules()
    {
        return [
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
