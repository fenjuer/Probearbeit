<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location_id' => 'exists:locations,id',
            'type_id' => 'required|exists:types,id',
            'players' => [
                0 => 'exists:players,id',
                1 => 'exists:players,id',
                2 => 'exists:players,id',
                3 => 'exists:players,id',
            ]
        ];
    }
}
