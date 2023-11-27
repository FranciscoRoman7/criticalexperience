<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'name', 'file_data'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
