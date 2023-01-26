<?php

namespace App\Http\Requests;

use App\Services\CountryService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PhoneFilterRequest extends FormRequest
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
            'country' => ['nullable', Rule::in((new CountryService)->getCountries()->pluck('country'))],
            'state' => ['nullable', Rule::in([true, false])],
        ];
    }

    public function messages()
    {
        return [
            'country' => 'Country Should Be Saved IN Our DB',
            'state' => 'State Should Be Valid or not Valid',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();

        foreach ($errors as $key => $value) {
            $errors[$key] = implode(', ', $value);
        }

        $info = [
            'success' => false,
            'message' => 'The given data was invalid.',
            'errors' => $errors
        ];

        $response = new JsonResponse($info, 422);

        throw new ValidationException($validator, $response);
    }
}
