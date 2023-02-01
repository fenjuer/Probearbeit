<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoundRequest extends FormRequest
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
            'game_id' => 'exists:games,id',
            'playersTeam1' => [
                'player1' => [
                    'id' => 'exists:players,id',
                    'positionId' => 'exists:positions,id',
                ],
                'player2' => [
                    'id' => 'exists:players,id',
                    'positionId' => 'exists:positions,id',
                ],
            ],
            'playersTeam2' => [
                'player1' => [
                    'id' => 'exists:players,id',
                    'positionId' => 'exists:positions,id',
                ],
                'player2' => [
                    'id' => 'exists:players,id',
                    'positionId' => 'exists:positions,id',
                ],
            ]
        ];
    }
}
