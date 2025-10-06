<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // pastikan true, biar semua user bisa update
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori' => 'required|string|max:255',
        ];
    }
}


