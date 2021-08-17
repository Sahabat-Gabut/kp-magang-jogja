<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed role_id
 * @property mixed|null agency_id
 * @property mixed jss_id
 * @property mixed role_admin_id
 */
class AdminRequest extends FormRequest
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
            'jss_id' => ['required'],
            'role_id' => ['required'],
            'agency_id' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'jss_id.required' => 'ID JSS Wajib Diisi!',
            'role_id.required' => 'Role Admin Wajib Dipilih!',
            'agency_id.required' => 'Dinas Wajib Dipilih!',
        ];
    }
}
