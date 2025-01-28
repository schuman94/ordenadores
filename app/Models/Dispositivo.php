<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    /** @use HasFactory<\Database\Factories\DispositivoFactory> */
    use HasFactory;

    protected $fillable = ['codigo', 'nombre', 'colocable_id', 'colocable_type'];

    public function colocable() {
        return $this->morphTo();
    }
}
