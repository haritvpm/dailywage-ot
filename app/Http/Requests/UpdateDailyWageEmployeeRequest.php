<?php

namespace App\Http\Requests;

use App\Models\DailyWageEmployee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDailyWageEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daily_wage_employee_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'ten' => [
                'string',
                'required',
                'unique:daily_wage_employees,ten,' . request()->route('daily_wage_employee')->id,
            ],
            'designation_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
