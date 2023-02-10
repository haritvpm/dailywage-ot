<?php

namespace App\Http\Requests;

use App\Models\Calender;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCalenderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('calender_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:calenders,id',
        ];
    }
}
