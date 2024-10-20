<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class CheckOutRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'number_phone' => 'required|numeric|digits_between:10,11',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|exists:tinhthanhpho,matp',
            'district' => 'required|exists:quanhuyen,maqh',
            'ward' => 'required|exists:xaphuongthitran,xaid',
            'payments' => 'required|in:cash,credit_card',
            'notes' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập Họ và tên',
            'number_phone.required' => 'Vui lòng nhập Số điện thoại liên hệ',
            'number_phone.numeric' => 'Nhập đúng định dạng Số điện thoại',
            'number_phone.digits_between' => 'Số điện thoại có độ dài 10-11 số',
            'email.required'  => 'Vui lòng nhập địa chỉ Email',
            'email.email'  => 'Vui lòng nhập đúng định dang email có @',
            'city.exists' => 'Vui lòng chọn Tỉnh/Thành phố.',  // Thêm dòng này
            'district.required' => 'Vui lòng chọn Quận/Huyện',
            'ward.required' => 'Vui lòng chọn Xã/Phường/Thị trấn',
            'address.required' => 'Nhập địa chỉ chi tiết',
            'payments.required' => 'Chọn phương thức thanh toán',
        ];
    }
    protected function failedValidation(Validator $validator) 
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}
