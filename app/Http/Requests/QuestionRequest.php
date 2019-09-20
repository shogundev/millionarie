<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'question' => 'required|string',
            'points' => 'required',
            'status' => 'required|in:active,draft',
            'correct' => 'required'
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['choices' => 'required'];
        }

        return $rules;

    }
}
