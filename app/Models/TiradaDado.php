<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiradaDado extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_usuario',
        'tipo_dado',
        'bonificador',
        'resultado',
        'total', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email_usuario', 'email');
    }
}
