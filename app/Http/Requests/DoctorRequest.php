<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name_en" => "required|max:255",
                "name_ar" => "required|max:255",
                "information_ar" => "max:255",
                "information_en" => "max:255",
                "abbreviation_ar" => "max:255",
                "abbreviation_en" => "max:255",
                "gender" => "required",
                "provider_id" => "required|numeric|exists:providers,id",
                "nickname_id" => "required|numeric|exists:doctor_nicknames,id",
                "specification_id" => "required|numeric|exists:specifications,id",
                "nationality_id" => "required|numeric|exists:nationalities,id",
                "price" => "required|numeric",
                "status" => "required|in:0,1",
                //  "insurance_companies"   => "required|array|min:1",
                //"insurance_companies.*"   => "required",
                "reservation_period" => "sometimes|nullable|numeric|min:0",
                "waiting_period" => "sometimes|nullable|numeric|min:0",
                "workingDay" => "required|array|min:1",
        ];
    }
}
