<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use App\Models\Token;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CampaignRequest extends FormRequest
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
            'company_id' => ['bail','required','numeric','exists:companies,id'],
            'token_id' => ['bail','nullable','numeric','exists:tokens,id'],
            'name' => ['bail','required','regex:/^[a-zA-Z0-9 ]+$/',
                Rule::exists('tokens')->where(function ($query) {
                    if($this->token_id == NULL) return true;
                    return $query->where('id',$this->token_id)->where('company_id',$this->company_id);

                }),

            ],
        ];

    }



    public function messages(){
        return [
            "name.exists" => 'Unsuccessful = Combination of token_id and company_id not matches.',
        ];
    }
}
