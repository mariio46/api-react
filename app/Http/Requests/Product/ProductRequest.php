<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('management products') ? true : false;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:5', 'max:255', Rule::unique(Product::class)->ignore($this?->product, 'id'),
            ],
            'description' => [
                'required', 'string', 'min:25',
            ],
            'price' => [
                'required', 'numeric', 'min:500', 'max:100000',
            ],
        ];
    }
}
