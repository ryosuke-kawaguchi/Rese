<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'time' => 'required',
            'member' => 'required|integer|min:1',
            'shop_name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => '予約日を選択してください。',
            'date.date' => '有効な日付を入力してください。',
            'time.required' => '予約時間を選択してください。',
            'member.required' => '予約人数を入力してください。',
        ];
    }
}
