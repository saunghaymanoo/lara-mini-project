<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            "name" => "required|unique:items",
            "code" => "required|unique:items,code|min:4",
            "subcategory" => "required|exists:sub_categories,id",
            "price" => "required|numeric",
            "discount" => "nullable|numeric",
            "photo" => "nullable|mimes:jpeg,jpg,png|file|max:512"
        ];
    }
}
