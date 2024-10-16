<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";
    protected $primaryKey = "customer_id";
    public $timestamps = false;

    protected $appends = ["gold_memeber"];


    public function goldMember(){
        return $this->points > 2000;
    }

    public function order(): HasMany {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}
