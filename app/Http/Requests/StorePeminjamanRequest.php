<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isPeminjam();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal_pinjam' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_kembali_rencana' => ['required', 'date', 'after:tanggal_pinjam'],
            'catatan' => ['nullable', 'string', 'max:500'],
            'alat' => ['nullable', 'array'],
            'alat.*' => ['integer', 'min:1'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam minimal hari ini.',
            'tanggal_kembali_rencana.required' => 'Tanggal rencana kembali wajib diisi.',
            'tanggal_kembali_rencana.after' => 'Tanggal rencana kembali harus setelah tanggal pinjam.',
            'alat.*.min' => 'Jumlah minimal 1.',
        ];
    }
}
