<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Code\Throwable;

class AdminController extends Controller
{
    public function adminDashboard(Request $request)
    {
        $data = [
            'pageTitle' => 'Dashboard'
        ];
        return view('back.pages.dashboard', $data);
    }

    /**
     * Manipulador do evento de sair de uma conta
     *
     * @param  Request $request
     * @return void
     */
    public function logoutHandler(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('fail', 'You are now logged out!');
    }

    public function profileView(Request $request)
    {
        try {
            $data = [
                'pageTitle' => 'Profile'
            ];

            return view('back.pages.profile', $data);
        } catch (Throwable $e) {
            Log::error("Erro ao carregar a página de perfil: " . $e->getMessage());

            return redirect()->route('admin.dashboard')->with('error', 'Erro ao abrir perfil.');
        }
    }
}
