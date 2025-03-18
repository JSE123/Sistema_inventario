<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurshaseDetail extends Model
{
    protected $fillable = [
        "purshase_id",
        "product_id",
        "quantity",
        "unit_price"
    ];
    public function purshase()
    {
        return $this->belongsTo(Purshase::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
