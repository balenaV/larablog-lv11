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

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Verifica a validade e o tempo de expiração de um token de redefinição de senha.
     * * Se o token for encontrado e for válido, retorna true.
     * * Se o token estiver expirado, ele é removido do banco e uma mensagem de erro é retornada.
     * * Se o token não existir, uma mensagem de erro é retornada.
     *
     * @param string $token O token único de redefinição.
     * @return bool|string Retorna true para válido ou uma string com a mensagem de erro.
     */
    public static function checkToken($token): bool|string
    {
        $record = self::where('token', $token)->first(); // Consulta o token no banco de dados

        if (!$record) return 'Invalid token. Request another reset password link.'; // Se não encontrar nenhum token retorna invalido

        // Se encontrar um token expirado
        if ($record->created_at->addMinutes(15)->isPast()) {
            $record->delete();
            return 'The password reset link you clicked has expired. Please request a new link.';
        }

        return true;
    }
}
