<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            "name_en" => "sometimes|nullable|max:255",
            "name_ar" => "sometimes|nullable|max:255",
            "branch_id" => "required|numeric|exists:branches,id",
            "status" => "required|in:0,1",

        ];
    }
}
