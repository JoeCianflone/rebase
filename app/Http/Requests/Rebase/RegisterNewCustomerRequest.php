<?php

namespace App\Http\Requests\Rebase;

use App\Rules\Rebase\SlugIsNotBanned;
use Illuminate\Foundation\Http\FormRequest;

class RegisterNewCustomerRequest extends FormRequest
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
            'slug' => ['required', 'unique:lookup,slug', 'min:3', 'max:100', new SlugIsNotBanned()],
            'plan' => ['required'],
            'name' => ['required', 'max:200', 'string'],
            'email' => ['required', 'email', 'max:200'],
            'line1' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal_code' => ['required', 'string', 'max:5'],
            'agreed_to_terms' => ['required'],
            'agreed_to_privacy' => ['required'],
            'line1' => ['required', 'string'],
        ];
    }

    public function payload(): array
    {
        return $this->request->all();
    }
}
