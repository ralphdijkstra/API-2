<?php

namespace App\Http\Requests;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMovieRequest extends FormRequest
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
            'title' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $errors,
            ], 422)
        );
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $client = new Client();
            $apiKey = 'bc72560d';

            // Search for the movie by title in OMDB API
            $response = $client->get("http://www.omdbapi.com/?t={$this->title}&y={$this->year}&apikey={$apiKey}");
            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() !== 200 || !isset($data['Poster']) || $data['Poster'] === 'N/A') {
                $validator->errors()->add('poster_url', 'Unable to fetch the poster URL from OMDB API.');
            } else {
                $this->merge([
                    'title' => $data['Title'],
                    'year' => $data['Year'],
                    'poster_url' => $data['Poster'],
                ]);
            }
        });
    }
}
