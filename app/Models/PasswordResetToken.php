<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    // Configurações a serem feita pro banco, para que o Eloquent possa entender certas configurações que fogem do padrao Laravel
    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false; // Para não forçar a criar automaticamente com updated_at, pois a tabela tem apenas created_at

    protected $fillable = ['email', 'token', 'created_at'];
}
