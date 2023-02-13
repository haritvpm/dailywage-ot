<?php

namespace App\Http\Requests;

use App\Models\DutyFormItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDutyFormItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('duty_form_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:duty_form_items,id',
        ];
    }
}
