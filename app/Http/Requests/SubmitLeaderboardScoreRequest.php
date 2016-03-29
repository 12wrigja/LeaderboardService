<?php

namespace App\Http\Requests;

class SubmitLeaderboardScoreRequest extends Request
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
            'score'=>'required|integer|min:0',
            'match_type'=>'required|in:1m,5m,10m'
        ];
    }
}
