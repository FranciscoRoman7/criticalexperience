<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ambientacion', 'descripcion'];

    public function user()
    {
        return $this->belongsTo(User::class, 'email_usuario', 'email');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
    
}
