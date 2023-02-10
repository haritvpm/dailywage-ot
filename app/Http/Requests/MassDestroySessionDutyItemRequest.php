<?php

namespace App\Http\Requests;

use App\Models\SessionDutyItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySessionDutyItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('session_duty_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:session_duty_items,id',
        ];
    }
}
