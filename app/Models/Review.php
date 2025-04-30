<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewReply;


class Review extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'customer_id', 'rating', 'review'];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }


public function replies()
{
    return $this->hasMany(ReviewReply::class, 'review_id');
}

}
