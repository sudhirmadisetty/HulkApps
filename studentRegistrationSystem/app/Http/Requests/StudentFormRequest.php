<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:students_details,email',
            'dob' => 'required',
            'address' => 'required',
        ];
    }

    public function messages(){

        return [
            'name.required' => 'Student name is Required',

            'email.required'=> 'Student Email is Required',
            'email.email'=> 'Email must be correct format',
            'email.unique'=> 'Email already exists!',

            'dob.required' => 'Student Date of Birth is Required',

            'address.required' => 'Student Address is Required',
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        $messages = $validator->messages();
        foreach ($messages->all() as $message)
        {
            withError($message);
        }

        return $validator->errors()->all();
    }
}
