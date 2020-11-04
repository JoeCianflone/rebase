<?php

namespace App\Http\Requests\Rebase;

use Illuminate\Foundation\Http\FormRequest;

class ValidateWorkspaceRequest extends FormRequest
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
            'email' => ['required'],
            'password' => ['required', 'confirmed', 'min:8', 'max:200'],
        ];
    }
}
