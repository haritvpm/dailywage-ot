<?php

namespace App\Http\Requests;

use App\Models\DutyForm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDutyFormRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('duty_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:duty_forms,id',
        ];
    }
}
