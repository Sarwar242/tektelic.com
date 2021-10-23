<?php
/*#SID - 44-new-website-page-knowledge */
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'blog_category_id' => 'required',
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'author' => 'required|min:2|max:255',
            'reading_time' => 'required|min:2|max:255',
            'added_date' => 'required',
            'banner_image' => 'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
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
    public function messages(): array
    {
        return [
            //
        ];
    }
}
