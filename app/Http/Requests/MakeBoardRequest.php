<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'board_name' => 'required|string|regex://gm',
            'board_uri' => 'required|string|not_regex:/\n|\s/gm|unique:App\Model\BoardModel, board_uri', // no whitespace or newline
            'board_description' => 'required|string',
            'is_frozen' => 'boolean',
            'is_secret' => 'boolean',
            'state' => 'exists:'
        ];
    }
}
