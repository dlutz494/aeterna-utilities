<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditContextRequest extends FormRequest
{
    const MAX_TITLE_LENGTH = 50;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'unique:contexts,title,' . $this->context->id,
                'max:' . self::MAX_TITLE_LENGTH,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A Title is needed',
            'title.string'   => 'The Title has to be a string',
            'title.unique'   => 'That Title is already in use',
            'title.max'      => 'That Title is too long (Maximum ' . self::MAX_TITLE_LENGTH . ' Characters)',
        ];
    }
}
