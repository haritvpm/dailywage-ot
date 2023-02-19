<?php

namespace App\Http\Requests;

use App\Models\DutyForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDutyFormRequest extends FormRequest
{
    public function authorize()
    {
        return 1;//Gate::allows('duty_form_create');
    }

    public function rules()
    {
        return [
            'total_hours' => [
                'numeric',
            ],
            
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
