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
            'contexts'    => ['present', 'array'],
            'contexts.*'  => ['present', 'exists:contexts,id', 'distinct'],
            'weights'     => ['array'],
            'weights.*'   => ['required', 'integer', 'min:1'],
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
            'contexts.*.exists'    => 'That Context does not exist',
            'contexts.*.distinct'  => 'That Context is already selected',
            'weights'              => 'Weights need to be in array form',
            'weights.*.required'   => 'A Weight is needed',
            'weights.*.integer'    => 'Weight has to be an integer',
            'weights.*.min'        => 'Weight has to be greater than 0',
        ];
    }
}
