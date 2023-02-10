<?php

namespace App\Http\Requests;

use App\Models\SingleDayDutyItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySingleDayDutyItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('single_day_duty_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:single_day_duty_items,id',
        ];
    }
}
