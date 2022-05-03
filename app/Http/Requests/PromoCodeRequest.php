<?php

namespace App\Http\Requests;

use App\Models\EventDefinition;
use App\Models\PromoCodeDefinition;
use App\Utils\DateUtil;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
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
        'event_id' => [
            'required',
            Rule::exists(EventDefinition::TABLE_NAME, EventDefinition::ID)
        ],

        'available_count'=>[
            'required',
            'numeric'
        ],

        'expiration_date'=>[
            'required',
            'date_format:'.DateUtil::DATE_FORMAT_DASHED,
            'after_or_equal:'.Carbon::now()
        ],
    ];
            
        
    }
}
