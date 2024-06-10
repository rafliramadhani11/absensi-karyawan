<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'kode' => ['string'],
            'slug' => ['string'],
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'min:5', 'unique:users,email,except,id'],
            'password' => ['required', 'string', 'max:50', 'min:3'],
            'tanggalLahir' => ['required', 'string', 'date'],
            'jeniskelamin' => ['required', Rule::in(['Laki - Laki', 'Perempuan'])],
            'jabatan' => [
                'required', Rule::in([
                    'Direktur Utama',
                    'Manajer Proyek',
                    'Pengawas Lapangan',
                    'Kepala Gudang',
                    'Finance',
                    'Purchasing',
                    'Supervisor',
                ]),
            ],
            'alamat' => ['required', 'string', 'max:255', 'min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Nama terlalu pendek',
            'name.required' => 'Nama tidak boleh kosong',

            'email.min' => 'Email terlalu pendek',
            'email.required' => 'Email tidak boleh kosong',
            'email.exists' => 'Email sudah ada !',

            'password.required' => 'Password wajib di isi!',

            'alamat.required' => 'Alamat harus di isi',

            'tanggalLahir.required' => 'Tanggal Lahir harus di pilih',

            'jeniskelamin.required' => 'Jenis Kelamin harus di pilih',

            'jabatan.required' => 'Jabatan harus dipilih'
        ];
    }
}
