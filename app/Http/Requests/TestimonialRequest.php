<?php
//#SID - 46-testimonials-slider-section-for-the-homepage
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required|min:2|max:255',
            'logo' => 'required',
            'speaker_name' => 'required|min:2|max:255',
            //'speaker_pic' => 'required',
            'position' => 'required|min:2|max:255',
            'quote' => 'required|min:2|max:1500',
            'website_link' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
