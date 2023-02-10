<?php

namespace App\Http\Requests;

use App\Models\Session;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('session_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:sessions',
            ],
            'assembly' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'session' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
