<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Order extends Model
// {
//     use HasFactory;
// }



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'payment_method',
        'booking_date',
        'paid_amount',
        'customer_id',
    ];

    // An order belongs to a customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    
    // An order has many order details
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
    
}
