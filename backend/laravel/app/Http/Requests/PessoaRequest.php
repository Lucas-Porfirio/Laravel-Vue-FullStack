<?php

namespace App\Http\Requests;

use App\Enums\PessoaTipoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PessoaRequest extends FormRequest
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
        $validaTipo = function ($attribute, $value, $fail) {
            $tipo = $this->input('tipo');

            if ($tipo == PessoaTipoEnum::FISICA->value && strlen($value) !== 11) {
                $fail('O CPF deve ter 11 dígitos para pessoa física.');
            } elseif ($tipo == PessoaTipoEnum::JURIDICA->value && strlen($value) !== 14) {
                $fail('O CPF deve ter 14 dígitos para pessoa jurídica.');
            }
        };
        switch ($this->route()->getActionMethod()) {
            case 'update':
                return [
                    'nome' => 'sometimes|string|max:255',
                    'cpf' => ['sometimes', 'string', 'cpf_ou_cnpj', 'unique:pessoa,cpf,' . $this->route('pessoa')->id, $validaTipo],
                    'tipo' => ['sometimes', Rule::in(PessoaTipoEnum::getValues())],
                    'telefone' => 'nullable|string|max:15|celular_com_ddd',
                    'email' => 'nullable|email|unique:pessoa,email,' . $this->route('pessoa')->id,
                ];
            default:
                return [
                    'nome' => 'required|string|max:255',
                    'cpf' => ['required', 'string', 'cpf_ou_cnpj', 'unique:pessoa,cpf', $validaTipo],
                    'tipo' => ['required', Rule::in(PessoaTipoEnum::getValues())],
                    'telefone' => 'nullable|string|max:15|celular_com_ddd',
                    'email' => 'nullable|email|unique:pessoa,email',
                ];
        }
    }
}
