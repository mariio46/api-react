<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id',
        );
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(
            related: Type::class,
            foreignKey: 'type_id',
        );
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }
}
