<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;  
use Illuminate\Http\Exceptions\HttpResponseException;  

class StoreUser extends FormRequest
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
            //
            'name' => 'required|max:50',
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')
                // Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:6|confirmed',
        ];
    }
    /*
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください'
        ];
    }
    */

    protected function failedValidation( Validator $validator )
    {
        
        $response['message']  = $validator->errors()->all();

        throw new HttpResponseException(
            response()->json( $response, 400 )
        );
    }
}
