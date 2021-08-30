<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use App\Models\Token;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Null_;

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
            'token_id' => ['bail','nullable','numeric','exists:tokens,id',],
            'name' => ['bail','required','regex:/^[a-zA-Z0-9 ]+$/',],
            'company_id' => ['bail','required','numeric','exists:companies,id',
                Rule::exists('tokens')->where(function ($query) {
                    if($this->token_id == null) return true;
                    $query->where('id', $this->token_id);}
                ),
            ],
        ];

    }

    public function messages(){
        return [
            "company_id.exists" => 'Unsuccessful = Combination of token_id and company_id not matches.',
        ];
    }
}
