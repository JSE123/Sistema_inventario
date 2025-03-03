<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation_detail extends Model
{
    protected $fillable = [
        "quotation_id",
        "product_id",
        "quantity",
        "unit_price"
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
