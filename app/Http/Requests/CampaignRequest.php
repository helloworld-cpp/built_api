<?php

namespace App\Http\Requests;

use App\Rules\TokenRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'company_id' => ['required','numeric','exists:companies,id'],
            'name' => ['required','regex:/^[a-zA-Z0-9 ]+$/'],
            'token_id' => ['nullable','numeric','exists:tokens,id'],
        ];
    }
}
