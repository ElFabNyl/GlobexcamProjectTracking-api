<?php

namespace App\Http\Requests\Projet;

use Illuminate\Foundation\Http\FormRequest;

class ProjetStoreRequest extends FormRequest
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
            'title' => ['bail','string','required'],
            'client_email' => ['bail','required','email'],
            'general_price' => ['bail','int','required'],
            'amount_payed' => ['bail','int','required'],
            'ending_date' => ['bail','required'],
            'category' => ['bail','in:SITE WEB,GRAPHIC DESIGN,VIDEO'],
        ];
    }
}
