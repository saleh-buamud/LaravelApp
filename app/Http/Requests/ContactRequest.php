<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // adjust if you add auth to the API
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->input('name') ? trim($this->input('name')) : null,
            'email' => $this->input('email') ? trim($this->input('email')) : null,
            'subject' => $this->input('subject') ? trim($this->input('subject')) : 'New message',
            'message' => $this->input('message') ? trim($this->input('message')) : null,
        ]);
    }
}
