<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SerialMask;

class Update extends FormRequest
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
     * Get serial typeId after successfully validation.
     */
    public function passedValidation()
    {

        foreach ($this->validator->getRules() as $k => $attrRules) {
            if ($k == 'serial_number') {
                foreach ($attrRules as $rule) {
                    if ($rule instanceof SerialMask) {
                        $this->merge([
                            'typeId' => $rule->getTypeId()
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'serial_number' => [
                'required',
                new SerialMask(
                    DB::table('equipment_type')
                        ->select('id', 'mask')
                        ->get()
                )
            ],
        ];
    }

    public function messages()
    {
        return [
            'serial_number.required' => 'Serial number must be filled.',
            'serial_number.unique' => 'Equipment with this serial number already exist.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
