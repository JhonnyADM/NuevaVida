<?php

namespace App\Models\GestionCompraVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $incrementing = false; // Desactiva autoincremento
    protected $keyType = 'string'; // El tipo de clave primaria es string
    protected $table = 'producto';
    protected $fillable = ['id', 'nombre', 'descripcion', 'precio', 'stock', 'vencimiento', 'foto', 'categoria_id'];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function provedores()
    {
        return $this->belongsToMany(Provedor::class, 'nota_ingreso')
            ->withPivot('cantidad', 'fecha', 'total')
            ->withTimestamps();
    }
}
