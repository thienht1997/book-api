<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreBookValidation extends FormRequest
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
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'author_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'required',
            'introduce' => 'required',
        ];
    
    }
    public function messages(){
        return [
            'name.required' => 'Trường tên không được để trống',
            'name.required' => 'Trường tên không được để trống',
            'price.required' => 'Trường giá tiền không được để trống!',
            'price.numeric' => 'Trường giá tiền phải là số!',
            'quantity.required' => 'Trường số lượng không được để trống!',
            'quantity.numeric' => 'Trường số lượng phải là số!',
            'author_id.required' => 'Trường tác giả không được để trống!',
            'author_id.numeric' => 'Trường tác giả phải là số!',
            'category_id.required' => 'Trường danh mục không được để trống!',
            'category_id.numeric' => 'Trường danh mục phải là số!',
            'image.required' => 'Trường hình ảnh không được để trống!',
            'image.image' => 'Hình ảnh không hợp lệ!',
            'introduce.required' => 'Trường giới thiệu không được để trống!',
        ];
     }
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
     
}
