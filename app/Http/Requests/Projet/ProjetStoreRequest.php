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
            'title' => ['string','required'],
            'user_id' => ['required','required'],
            'assign_to' => ['string','required'],
            'starting_date' => ['datetime','required'],
            'ending_date' => ['datetime','required'],
            'status' => ['in:EN COUR,TERMINER, STOPPER'],
            'category' => ['in:SITE WEB,GRAPHIC DESIGN,VIDEO'],
        ];
    }
}
