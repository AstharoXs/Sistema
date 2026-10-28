<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_producto' => ['required', 'string', 'max:150'],
            'detalle_producto' => ['nullable', 'string', 'max:2000'],
            'cant_producto' => ['required', 'integer', 'min:0'],
            'valor_producto' => ['required', 'decimal:2', 'min:0'],
            'foto_producto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'estado_producto' => ['required', 'in:activo,inactivo'],
            'id_categoria' => ['required', 'exists:categorias,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom_producto.required' => 'Digite el nombre del producto.',
            'cant_producto.min' => 'La cantidad no puede ser negativa.',
            'valor_producto.min' => 'El precio no puede ser negativo.',
            'id_categoria.exists' => 'Seleccione una categoría válida.',
            'foto_producto.image' => 'El archivo debe ser una imagen.',
        ];
    }
}
