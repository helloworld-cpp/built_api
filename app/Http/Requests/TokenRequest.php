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
        Rule::unique('tokens', 'name','email_address')->ignore('id');

        return [
            'company_id' => ['required','numeric','exists:companies,id',],
            'name' => ['required','regex:/^[a-zA-Z0-9 ]+$/'],
        ];

    }
}
