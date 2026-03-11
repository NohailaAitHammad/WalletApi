<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'type' => ['sometimes','required', 'string'],
            'amount' => ['required','min:0', 'integer'],
            'wallet_id' => ['nullable'],
            'description' => ['nullable', 'string', 'max:255'],
            'receiver_wallet_id' => ['sometimes', 'required', 'exists:wallets,id'],
            'sender_wallet_id' => ['sometimes','required', 'exists:wallets,id'],
        ];
    }
}
