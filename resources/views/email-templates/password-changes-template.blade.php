<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Senha foi Alterada</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f7f9; font-family: 'Segoe UI', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #e1e8ed;">

                    <tr>
                        <td align="center" style="background-color: #1a1a1a; padding: 30px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px;">Larablog</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 50px 40px; text-align: center;">
                            <h2 style="color: #333333; margin-top: 0; font-size: 22px;">Olá, {{ $user->name }}</h2>
                            <h3 style="color: #555555; font-weight: 400; font-size: 18px;">Sua senha foi alterada com
                                sucesso!</h3>

                            <p style="color: #718096; font-size: 16px; line-height: 1.6; margin: 25px 0;">
                                Informamos que a senha da sua conta foi atualizada.<br>
                                Confira seus dados de acesso abaixo:
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="background-color: #f8fafc; border: 1px solid #edf2f7; border-radius: 6px; margin: 30px 0;">
                                <tr>
                                    <td style="padding: 20px; text-align: left;">
                                        <p style="margin: 0; color: #718096; font-size: 14px;"><strong>E-mail/Username:</strong>
                                            {{ $user->email }} ou  {{ $user->username }}</p>
                                        <p style="margin: 10px 0 0; color: #718096; font-size: 14px;"><strong>Nova
                                                Senha:</strong> <code
                                                style="background-color: #ffffff; padding: 2px 6px; border: 1px solid #e1e8ed; border-radius: 4px; color: #333333;">{{ $new_password }}</code>
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" style="margin: 35px auto;">
                                <tr>
                                    <td align="center" bgcolor="#0d6efd" style="border-radius: 6px;">
                                        <a href="{{ route('admin.login') }}" target="_blank"
                                            style="display: inline-block; padding: 14px 35px; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 16px;">
                                            Acessar minha Conta
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="color: #a0aec0; font-size: 13px; line-height: 1.5; margin-top: 40px; border-top: 1px solid #edf2f7; padding-top: 20px;">
                                Se você não realizou essa alteração, recomendamos que entre em contato com nosso suporte
                                imediatamente para proteger sua conta.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background-color: #f8fafc; padding: 30px; text-align: center; border-top: 1px solid #edf2f7;">
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                &copy; {{ date('Y') }} Larablog - Maringá, PR
                            </p>
                            <p
                                style="margin: 5px 0 0 0; color: #cbd5e1; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                Este é um e-mail automático, por favor não responda.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
