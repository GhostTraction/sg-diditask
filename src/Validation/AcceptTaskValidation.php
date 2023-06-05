<?php

namespace DiDiTask\Seat\SeatDiDiTask\Validation;

use Illuminate\Foundation\Http\FormRequest;

class AcceptTaskValidation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'missionList' => 'string',

        ];
    }

}