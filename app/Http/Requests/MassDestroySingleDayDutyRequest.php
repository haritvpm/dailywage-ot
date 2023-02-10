<?php

namespace App\Http\Requests;

use App\Models\SingleDayDuty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySingleDayDutyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('single_day_duty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:single_day_duties,id',
        ];
    }
}
