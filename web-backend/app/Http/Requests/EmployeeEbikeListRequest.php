<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeEbikeListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    private static $whiteListFilter = [
        'id',
        'employee_id',
        'e_bike_id',
        'date_from',
        'date_to',
    ];
    public function rules()
    {
        
    //     static $sortFieldsWhiteList = [
        // 'id',
        // 'employee_id',
        // 'e_bike_id',
        // 'date_from',
        // 'date_to',
    // ];
        // $sortFieldsWhiteList = [
        //     'id',
        //     'employee_id',
        //     'e_bike_id',
        //     'date_from',
        //     'date_to',
        // ];

        return [
            'sort_field' => ['nullable', Rule::in([
                'id',
                'employee_id',
                'e_bike_id',
                'date_from',
                'date_to',
            ])],
            'sort_order' => ['nullable', Rule::in(['asc', 'desc'])],
            'search' => ['nullable', 'string', 'min:1', 'max:150'],
            // 'startDateSearch' => ['nullable', 'string'],
            // 'endDateSearch' => ['nullable', 'string']  
        ];
    }
}
