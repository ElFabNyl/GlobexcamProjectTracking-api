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
            'title' => ['string'],
            'user_id' => [''],
            'assign_to' => ['string'],
            'starting_date' => ['datetime'],
            'ending_date' => ['datetime'],
            'status' => ['in:EN COUR,TERMINER, STOPPER'],
            'category' => ['in:SITE WEB,GRAPHIC DESIGN,VIDEO'],
        ];
    }
}
