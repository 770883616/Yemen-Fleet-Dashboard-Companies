<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'quantity',
        'price',
        'offer_id',
        'company_id',
        'image', 
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    // العلاقات الأساسية
    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
    public function reviews() {
        return $this->hasMany(CustomerReview::class, 'product_id');
    }

    // الوظائف المذكورة في الكلاس دايجرام
    public function updateStock(int $quantity)
    {
        $this->decrement('quantity', $quantity);
        return $this->fresh();
    }

    public function applyDiscount(Offer $offer)
    {
        $this->update([
            'price' => $this->price * (1 - ($offer->discount / 100)),
            'offer_id' => $offer->offer_id
        ]);
        return $this;
    }

    public function getCurrentPrice()
    {
        return $this->offer_id
            ? $this->price * (1 - ($this->offer->discount / 100))
            : $this->price;
    }
}
