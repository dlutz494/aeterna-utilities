<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEncounterRequest extends FormRequest
{
    const MAX_TITLE_LENGTH = 255;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'unique:encounters', 'max:' . self::MAX_TITLE_LENGTH],
            'description' => ['required', 'string'],
            'context_id'  => ['nullable', 'integer', 'exists:contexts,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'A Title is needed',
            'title.string'         => 'The Title has to be a string',
            'title.unique'         => 'That Title is already in use',
            'title.max'            => 'That Title is too long (Maximum ' . self::MAX_TITLE_LENGTH . ' Characters)',
            'description.required' => 'A Description is needed',
            'description.string'   => 'The Description has to be a string',
            'context_id.integer'   => 'The Context has to be an integer',
            'context_id.exists'    => 'That Context does not exist',
        ];
    }
}
