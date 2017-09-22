<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
        $rules = User::$rules;
        $rules['roles'] = 'array|required';
        $rules['roles.*'] = 'exists:roles,id';

        return $rules;
    }

    public function messages()
    {
        return [
            'roles.*.exists' => 'The selected role is invalid.'
        ];
    }
}
