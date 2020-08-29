<?php

namespace App\Http\Requests;

use App\Rules\SlugIsNotBanned;
use Illuminate\Foundation\Http\FormRequest;

class SlugRequest extends FormRequest
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
            'slug' => ['required', 'unique:workspaces,slug', new SlugIsNotBanned()],
        ];
    }

    public function payload(): array
    {
        return $this->request->all();
    }
}
