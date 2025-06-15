<?php

namespace App\Models\GestionCompraVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'producto';
    protected $fillable = ['id', 'nombre', 'descripcion', 'precio', 'stock', 'vencimiento', 'foto', 'categoria_id'];

    protected $casts = [
        'precio' => 'float',
        'stock' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function recibos()
    {
        return $this->belongsToMany(Recibo::class, 'detalle')
            ->withPivot('cantidad', 'subtotal')
            ->withTimestamps();
    }
}
