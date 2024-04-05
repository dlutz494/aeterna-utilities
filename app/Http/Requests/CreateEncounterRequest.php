<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEncounterRequest extends FormRequest
{
    const MAX_TITLE_LENGTH = 255;
    const MAX_LOCATION_LENGTH = 50;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'unique:encounters', 'max:' . self::MAX_TITLE_LENGTH],
            'description' => ['required', 'string'],
            'location'    => ['nullable', 'string', 'max:' . self::MAX_LOCATION_LENGTH],
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
            'location.string'      => 'The Location has to be a string',
            'location.max'         => 'That Location is too long (Maximum ' . self::MAX_LOCATION_LENGTH . ' Characters)',
        ];
    }
}
