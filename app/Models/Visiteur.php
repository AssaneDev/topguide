<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;
     protected $table = 'visiteurs';

    protected $fillable = [
        'ip',
        'pays',
        'ville',
        'url',
        'visited_at',
    ];

    public $timestamps = true;
}
