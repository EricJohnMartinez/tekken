<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            'department' => 'nullable',
            'home_address' => 'nullable',
            'employment_status' => 'nullable',
            'age' => 'nullable',
            'photo' => 'nullable|image|max:10240',
            'resume' => 'nullable|mimes:docx,pdf,doc|max:10240',
            'year_graduated' => 'nullable',
            'work_company' => 'nullable',
            'work_address' => 'nullable',
            'position_on_work' => 'nullable',
            'date_hired' => 'nullable',
            'employed_status' => 'nullable',
            'civil_service' => 'nullable',
            'job_to_course' => 'nullable',
            'monthly_income' => 'nullable',
            'status' => 'nullable',
        ];

        if (!Auth::user()->hasRole('employer'))
            { $rules = [
                'email' => 'required|email',
                'name' => 'required',
                'department' => 'required',
                'home_address' => 'required',
                'employment_status' => 'required',
                'age' => 'required',
                'photo' => 'nullable|image|max:10240',
                'resume' => 'nullable|mimes:docx,pdf,doc|max:10240',
                'year_graduated' => 'nullable',
                'work_company' => 'nullable',
                'work_address' => 'nullable',
                'position_on_work' => 'nullable',
                'date_hired' => 'nullable',
                'employed_status' => 'nullable',
                'civil_service' => 'required',
                'job_to_course' => 'nullable',
                'monthly_income' => 'nullable',
                'status' => 'nullable'
            ];
            }
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'name.required' => 'Please enter your name.',
            'home_address.required' => 'Please enter your home address.',
            'employment_status.required' => 'Please enter your employment status.',
            'age.required' => 'Please enter your age.',
            'year_graduated.required' => 'Please enter the year you graduated.',
            'work_company.required' => 'Please enter your work company.',
            'work_address.required' => 'Please enter your work address.',
            'position_on_work.required' => 'Please enter your position at work.',
            'date_hired.required' => 'Please enter the date you were hired.',
            'employed_status.required' => 'Please enter your employed status.',
            'civil_service.required' => 'Please enter your civil service status.',
            'job_to_course.required' => 'Please enter your job to course.',
            'monthly_income.required' => 'Please enter your monthly income.',
            'status.required' => 'Please enter your status.',
            'photo.image' => 'Please upload a valid image file.',
        ];
    }
}
