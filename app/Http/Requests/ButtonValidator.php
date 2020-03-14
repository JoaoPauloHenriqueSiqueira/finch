<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ButtonValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_id' => 'required|exists:tasks,id',
            'next_id' => 'required|exists:tasks,id'
            ];
    }

    public function messages()
    {
        return [
            'task_id.required' => 'Tarefa é um campo necessário',
            'next_id.required'  => 'Próxima Tarefa é um campo necessário'
        ];
    }
}
