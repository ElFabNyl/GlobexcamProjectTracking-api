<?php

namespace App\Http\Requests\Projet;

use Illuminate\Foundation\Http\FormRequest;

class ProjetUpdateRequest extends FormRequest
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
            'title' => ['bail','string'],
            'client_email' => ['bail','required','email'],
            'general_price' => ['bail','int'],
            'description' => ['bail','string','max:200'],
            'amount_payed' => ['bail','int'],
            'ending_date' => ['bail','date'],
            'category' => ['bail','in:SITE WEB,GRAPHIC DESIGN,VIDEO'],
        ];
    }
}
