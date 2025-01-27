<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "order_id";
    public $timestamps = false;

   

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

}
