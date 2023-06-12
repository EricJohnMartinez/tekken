<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('store job');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'title' => 'required',
            'company' => 'required',
            'descript' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:10240',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
