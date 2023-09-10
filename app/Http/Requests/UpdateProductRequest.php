<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'string|max:100',
            'description' => 'string|max:255',
            'category' => 'string|max:50',
            'status' => 'in:ACTIVE,INACTIVE,DELETED'
        ];
    }

    public function validationData()
    {
        $data = $this->json()->all();
        $data['id'] = $this->route('id');

        return $data;
    }
}
