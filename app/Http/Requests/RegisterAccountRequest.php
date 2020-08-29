<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAccountRequest extends FormRequest
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
            'name' => ['required', 'max:200', 'string'],
            'business_name' => ['max:200', 'required_if:is_business,=,true'],
            'email' => ['required', 'email', 'max:200'],
            'address_line1' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal_code' => ['required', 'string', 'max:5'],
        ];
    }

    public function payload(): array
    {
        return $this->request->all();
    }

    protected function prepareForValidation(): void
    {
    }
}
