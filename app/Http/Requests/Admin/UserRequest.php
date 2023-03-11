<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            "name" => "required|string|max:100",
            "email" => "required|string|email|max:70",
            "password" => "required|string|max:60",
            "placed_in" => "required|string|in:" . join(',', [User::PLACED_IN_AMBON, User::PLACED_IN_BALI]),
        ];

        if ($this->isMethod('put')) {
            $rules['password'] = 'nullable|string|max:60';

            /**
             * @var User $user
             */
            $user = $this->route('user');

            if ($user->email != $this->email) {
                $rules['email'] = 'required|string|email|unique:users|max:70';
            }
        }

        return $rules;
    }
}
