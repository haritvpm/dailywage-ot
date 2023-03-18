<?php

namespace App\Http\Requests;

use App\Models\Calender;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCalenderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('calender_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
               
                'date_format:' . config('panel.date_format'),
            ],
            'type' => [
                'required',
            ],
        ];
    }
}
