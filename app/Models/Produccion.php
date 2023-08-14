<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    use HasFactory;
    protected $table = 'produccion';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'ref',
        'operario',
        'piezas_buenas',
        'piezas_malas',
        'fecha_inicio',
        'fecha_fin',
        'gastos_adicionales',
        'observaciones',
        'created_at',
        'updated_at'
    ];
}
