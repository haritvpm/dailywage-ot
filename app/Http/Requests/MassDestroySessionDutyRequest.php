<?php

namespace App\Http\Requests;

use App\Models\SessionDuty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySessionDutyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('session_duty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:session_duties,id',
        ];
    }
}
