<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
