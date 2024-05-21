<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
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
            'category' => [
                'required', Rule::exists(Category::class, 'id'),
            ],
            'type' => [
                'required', Rule::exists(Type::class, 'id'),
            ],
        ];
    }
}
