<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"     => "required|string|min:5|max:255",
            "username" => "required|string|min:5|max:255|unique:users",
            "email"    => "required|email|string|min:5|max:255|unique:users",
            "password" => "required|string|min:5|max:255|unique:users",
        ];
    }
}
