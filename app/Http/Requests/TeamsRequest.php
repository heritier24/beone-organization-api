<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class TeamsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "teamTitle" => "required|string",
            "teamPosition" => "required|string",
            "twitterLink" => "required|string",
            "facebookLink" => "required|string",
            "instagramLink" => "required|string",
            "linkedlnLink" => "required|string",
            "image_path" => "required|image|mimes:jpeg,png,jpg,gif,svg"
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()
                ->json(
                    [
                        "errors" => $validator->errors()->all()
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                ));
        }
    }
}
