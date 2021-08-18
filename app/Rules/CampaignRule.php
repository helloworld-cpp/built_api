<?php

namespace App\Rules;

use App\Models\Campaign;
use App\Models\Token;
use Illuminate\Contracts\Validation\Rule;

class CampaignRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if(array_key_exists("token_id",$this->data)
            && array_key_exists("name",$this->data)
            && array_key_exists("company_id",$this->data)
        ){
            $token_id = $this->data['token_id'];
            $company_id = $this->data['company_id'];
            $queryCount = Token::where('id',$token_id)->where('company_id',$company_id)->count();
            if( ($queryCount) == 0 ){
                return false;
            }
        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Unsuccessful = Combination of token_id and company_id not matches.';
    }
}
