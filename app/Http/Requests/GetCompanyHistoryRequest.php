<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class GetCompanyHistoryRequest extends FormRequest
{

    public $validator = null;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        if (!$this->request->has('submit')) {
            return [];
        }

        $companySymbol = $this->request->get('company_symbol');
        $endDate       = $this->request->get('end_date');

        return [
            'company_symbol' => [
                "required",
                "exists:companies,symbol,symbol,$companySymbol"
            ],
            'start_date'     => [
                'required',
                'date_format:Y-m-d',
                'before:' . date("Y-m-d", strtotime($endDate)),
            ],
            'end_date'       => [
                'required',
                'date_format:Y-m-d',
                'before:' . date("Y-m-d", strtotime("+1 day")),
            ],
            'email'          => [
                'required',
                'email'
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

}
