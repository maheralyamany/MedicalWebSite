<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PatientRequest extends FormRequest
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
            'patientname' =>  "required|max:255",
            "gender" => "required",
            "mobile" => "numeric",
            "age" => "numeric",
            'email' => 'sometimes|nullable|email',
            "city_id" => "required",
            "service_id" => "required",
        ];
    }
}
