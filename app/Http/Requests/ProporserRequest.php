<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProporserRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            $photoValidation = 'required';
        }elseif(request()->isMethod('put')){
            $photoValidation = 'sometimes';
        }
        return [
            'rt' => ['required', 'string'],
            'rw' => ['required', 'string'],
            'income' => ['required', 'string'],
            'nik' => ['required', 'string'],
            'kk' => ['required', 'string'],
            'name' => ['required', 'string'],
            'province' => ['required', 'string'],
            'regency' => ['required', 'string'],
            'district' => ['required', 'string'],
            'village' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'photo' => [$photoValidation, 'image'],
            'latitude' => ['required'],
            'longitude' => ['required']
        ];
    }
}
