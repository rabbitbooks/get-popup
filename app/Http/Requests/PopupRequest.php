<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PopupRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'max:20'],
            'text' => 'required|min:5',
            'is_enabled' => 'sometimes|in:1'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '"Название"',
            'text' => '"Текст"',
        ];
    }
}
