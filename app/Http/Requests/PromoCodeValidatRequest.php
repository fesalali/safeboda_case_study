<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeValidatRequest extends FormRequest
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
      
        'source_lat'=>[
            'required',
            'numeric'
        ],

        'source_lon'=>[
            'required',
            'numeric'
        ],

        'destination_lat'=>[
            'required',
            'numeric'
        ],

        'destination_lon'=>[
            'required',
            'numeric'
        ],

        'code'=>[
            'required'
        ],

        
    ];
            
        
    }
}
