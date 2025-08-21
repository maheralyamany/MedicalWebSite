<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class XrayRequest extends FormRequest
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
            'name_ar' =>  "required|max:255",
            'name_en' =>  "required|max:255",
            "xray_time" => "required",
            "price" => "required|numeric",
            "status" => "required|in:0,1",
        ];
    }
}
