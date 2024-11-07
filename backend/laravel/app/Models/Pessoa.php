<?php

namespace App\Models;

use App\Enums\PessoaTipoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoa';

    protected $fillable = [
        'nome',
        'cpf',
        'tipo',
        'telefone',
        'email',
    ];

    protected $casts = [
        'tipo' => PessoaTipoEnum::class
    ];
}
