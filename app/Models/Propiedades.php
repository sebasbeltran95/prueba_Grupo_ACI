<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedades extends Model
{
    use HasFactory;
    protected $table = 'propiedades';

    public function getKeyName(){
        return "idProperty";
    }

    public $fillable = [
        'idProperty',
        'name',
        'addres',
        'price',
        'codeinternacional',
        'year',
        'idOwner',
        'foto',
        'created_at',
        'updated_at'
    ];
    public function DUEÑOS(){
        return $this->belongsTo(Dueños::class, 'idOwner');
    }
}
