<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dueños extends Model
{
    use HasFactory;
    protected $table = 'dueños';

    public function getKeyName(){
        return "idOwner";
    }

    public $fillable = [
        'idOwner',
        'name',
        'addres',
        'foto',
        'birday',
        'created_at',
        'updated_at'
    ];
}
