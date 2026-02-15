<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'compare_price',
        'sku',
        'barcode',
        'track_quantity',
        'quantity',
        'is_active',
        'image',
        'images',
        'weight',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'track_quantity' => 'boolean',
        'is_active' => 'boolean',
        'images' => 'array',
        'weight' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function averageRating()
    {
        return $this->comments()->avg('rating') ?? 0;
    }

    public function getAverageRatingAttribute()
    {
        return round($this->averageRating(), 1);
    }

    public function isInStock()
    {
        return !$this->track_quantity || $this->quantity > 0;
    }

    public function getStockStatusAttribute()
    {
        if (!$this->track_quantity) {
            return 'Illimité';
        }
        
        if ($this->quantity <= 0) {
            return 'Rupture de stock';
        } elseif ($this->quantity <= 5) {
            return 'Stock faible (' . $this->quantity . ')';
        } else {
            return 'En stock (' . $this->quantity . ')';
        }
    }

    public function getStockBadgeColorAttribute()
    {
        if (!$this->track_quantity) {
            return 'primary';
        }
        
        if ($this->quantity <= 0) {
            return 'danger';
        } elseif ($this->quantity <= 5) {
            return 'warning';
        } else {
            return 'success';
        }
    }

    public function hasEnoughStock($requestedQuantity)
    {
        if (!$this->track_quantity) {
            return true;
        }
        
        return $this->quantity >= $requestedQuantity;
    }

    public function decreaseStock($quantity)
    {
        if ($this->track_quantity) {
            $this->quantity -= $quantity;
            $this->save();
        }
    }

    public function getFormattedPriceAttribute()
    {
        return '€' . number_format($this->price, 2);
    }

    public function getFormattedComparePriceAttribute()
    {
        return $this->compare_price ? '€' . number_format($this->compare_price, 2) : null;
    }
}
