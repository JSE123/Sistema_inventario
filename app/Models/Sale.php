<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = [
        'total',
        'client_id'
    ];

    // una venta tiene un detalle de venta
    public function saleDetails(){
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }

    // una venta pertenece a un usuario
    public function client(){

        return $this->belongsTo(Client::class);
    }
}
