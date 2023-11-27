<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evento extends Model
{
    use HasFactory;

    static $rules=[
        'title'=>'required',
        'descripcion'=>'required',
        'start'=>'required',
        'end'=>'required'
    ];

    protected $fillable=['title','descripcion','start','end'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($evento) {
            $evento->email = auth()->user()->email;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email_usuario', 'email');
    }

}
