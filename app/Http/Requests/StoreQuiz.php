<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;  
use Illuminate\Http\Exceptions\HttpResponseException; 

class StoreQuiz extends FormRequest
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
            'quiz.title' => 'required',
            'quiz.query' => 'required',
            'quiz.explanation' => 'required',
            'choices.*.content' => 'required',
            'choices.*.number' => 'required|integer|between:1, 4|distinct',
            'correct_choice_number' => 'required|integer|between:1, 4',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        
        $response['message']  = $validator->errors()->all();

        throw new HttpResponseException(
            response()->json( $response, 400 )
        );
    }
}
