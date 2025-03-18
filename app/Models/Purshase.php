<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purshase extends Model
{
    protected $fillable = [
        "supplier_id",
        "total"
    ];
    public function supplier()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function details()
    {
        return $this->hasMany(PurshaseDetail::class);
    }
}
