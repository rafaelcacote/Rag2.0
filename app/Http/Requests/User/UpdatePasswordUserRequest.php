<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordUserRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [

		];
	}

	public function rules()
	{
		return [
            'password' => 'required|string|min:6|confirmed',
            'confirm-password' => 'required|min:6'
		];
	}
}
