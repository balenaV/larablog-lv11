<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('back.pages.auth.forget', $data);
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
}
