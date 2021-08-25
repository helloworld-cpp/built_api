<?php

namespace App\Http\Requests;

use App\Models\Token;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class TokenRequest extends FormRequest
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




    public function rules()
    {
        return [
            'company_id' => ['bail','required','numeric','exists:companies,id',],
            'name' => ['bail','required','regex:/^[a-zA-Z0-9 ]+$/',
                Rule::unique('tokens')->where(function ($query) {
                    return $query->where('name',$this->name)->where('company_id',$this->company_id);
                }),
            ],
        ];
    }
    public function messages(){
        return [
            "name.unique" => 'Unsuccessful = Unique combination of name and company_id already exists.',
        ];
    }

}
