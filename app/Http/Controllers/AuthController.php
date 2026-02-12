<?php

namespace App\Http\Controllers;

use App\Helpers\CMail;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\UserStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Login'
        ];
        return view('back.pages.auth.login', $data);
    }

    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Forgot Password'
        ];
        return view('back.pages.auth.forgot', $data);
    }


    /**
     * Manipula o evento de Login
     *
     * @param  LoginRequest $request
     * @return void
     */
    public function loginHandler(LoginRequest $request)
    {
        $loginValue = $request->input('login_id'); // Recebe o valor do input (username/email)
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username'; // Valida o tipo de input de login recebido

        $credentials = [
            $fieldType => $loginValue,
            'password' => $request->password
        ];

        if (!(auth()->attempt($credentials))) // Valida se o Usuario é autenticado ou não
            return redirect()->route('admin.login')->withInput()->with('fail', 'Incorrect password.'); // Se não for, redirecionado para o Login novamente

        $authUserStatus = auth()->user()->status; // Identifica os status do Usuário autenticado

        if ($authUserStatus === UserStatus::Inactive || $authUserStatus === UserStatus::Pending) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = ($authUserStatus === UserStatus::Inactive)
                ? 'Your account is currently inactive. Please, contact support at (support@larablog.test) for further assistance'
                : 'Your account is currently pending approval. Please, check your email for further instructions or contact support at (support@larablog.test) assistance';

            return redirect()->route('admin.login')->with('fail', $message);
        }

        return redirect()->route('admin.dashboard');
    }

    public function sendPasswordResetLink(ForgotPasswordRequest $request)
    {

        // Dados do Usuario
        $user = User::where('email', $request->email)->first();

        // Geração do token
        $token = base64_encode(Str::random(64));

        // Faz a validação do Token
        // Se ja existir um, ele apenas atualiza as informações
        // Se não existir, ele cria um novo
        PasswordResetToken::updateOrCreate(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        $actionLink = route('admin.reset_password_form',['token'=>$token]);

        $data = [
            'actionlink' =>$actionLink,
            'user'=>$user
        ];

        $mail_body = view('email-templates.forgot-template',$data)->render();

        $mailConfig = [
            'recipient_address'=>$user->email,
            'recipient_name'=>$user->name,
            'subject'=>'Reset Password',
            'body'=>$mail_body
        ];

        return CMail::send($mailConfig)
            ? redirect()->route('admin.forgot')->with('success','We have e-mailed your password reset link.')
            : redirect()->route('admin.forgot')->with('fail','Something went wrong. Resetting password link not sent. Try again later.');
    }
}
