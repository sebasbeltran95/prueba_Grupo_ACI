<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rastreo extends Model
{
    use HasFactory;
    protected $table = 'rastreo';

    public function getKeyName(){
        return "idPropertyTrace";
    }

    public $fillable = [
        'idPropertyTrace',
        'datesale',
        'name',
        'value',
        'tax',
        'idProperty',
        'created_at',
        'updated_at'
    ];
    public function PROPIEDADES(){
        return $this->belongsTo(Propiedades::class, 'idProperty');
    }
}
