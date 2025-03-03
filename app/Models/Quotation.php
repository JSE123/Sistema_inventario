<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        "supplier_id",
        "status",
        "total"
    ];
    public function proveedor()
    {
        return $this->belongsTo(proveedor::class);
    }
    public function details()
    {
        return $this->hasMany(Quotation_detail::class);
    }
}
