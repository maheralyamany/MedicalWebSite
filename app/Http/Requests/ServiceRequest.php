<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ServiceRequest extends FormRequest
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
        $price ="numeric|min:0";
        $has_price = (int) $this->request->get('has_price');
        $priceVal = (float) $this->request->get('price');
        if($has_price==1&&$priceVal==0){
            // 'price.numeric' =>  trans('validation.numeric'),
            $price ="numeric|min:1";
         }
        return [
            "service_name" => "required|max:255",
            "department_id" => "required|numeric|exists:departments,id",
            "price" => $price,
            "has_price" => "required|in:0,1",
            "status" => "required|in:0,1",
            "workingDay" => "required|array|min:1",
        ];
    }
    public function messages()
    {
        return [
            'service_name.required' => trans('validation.required'),
            'service_name.max' => trans('validation.max.string'),
            'department_id.required' =>  trans('validation.required'),
            'has_price.required' =>  trans('validation.required'),
            'status.required' =>  trans('validation.required'),
            'price.numeric' =>  trans('validation.numeric'),
        ];
    }
}
