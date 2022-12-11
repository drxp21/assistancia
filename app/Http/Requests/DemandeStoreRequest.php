<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeStoreRequest extends FormRequest
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
            'status' => ['required', 'in:processed,pending,rejected'],
            'contenu' => ['required', 'string'],
            'auteur_id' => ['required', 'integer', 'exists:auteurs,id'],
            'admin_id' => ['required', 'integer', 'exists:admins,id'],
        ];
    }
}
