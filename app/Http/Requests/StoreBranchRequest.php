<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
            "name_ar" => "required|max:255",
            'email' => 'sometimes|nullable|email|max:100',
            "mobile" => "required|min:8|max:100",
            "status" => "required|in:0,1",
            "branch_days" => "required|array",

        ];
    }
}
