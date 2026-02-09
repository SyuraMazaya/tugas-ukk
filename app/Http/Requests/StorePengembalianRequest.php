<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengembalianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isPetugas() || $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal_kembali_real' => ['required', 'date'],
            'catatan_kondisi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'tanggal_kembali_real.required' => 'Tanggal pengembalian wajib diisi.',
            'tanggal_kembali_real.date' => 'Format tanggal tidak valid.',
            'catatan_kondisi.max' => 'Catatan kondisi maksimal 1000 karakter.',
        ];
    }
}
