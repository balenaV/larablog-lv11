<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Code\Throwable;
use SawaStacks\Utils\Kropify;

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

    /**
     * Renderiza view de Perfil do Usuário
     *
     * @param  Request $request
     * @return void
     */
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

    /**
     * Atualiza imagem de Perfil de Usuário
     *
     * @param  Request $request
     * @return void
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profilePictureFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $file = $request->file('profilePictureFile');
        $filename = 'IMG_' . uniqid() . '.png';
        $path = 'images/users/';

        // Upload da imagem utilizando Kropify
        $uploadImage = Kropify::getFile($file, $filename)->setPath($path)->useMove()->save();

        if ($uploadImage) {
            $oldPicture = $user->getRawOriginal('picture');

            if ($oldPicture && File::exists(public_path($path . $oldPicture))) {
                File::delete(public_path($path . $oldPicture));
            }

            $user->update(['picture' => $filename]); // Atualiza imagem do usuário no banco de dados

            return response()->json([
                'status' => 1,
                'message' => 'Sua foto de perfil foi atualizada com sucesso!'
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Algo deu errado ao salvar a imagem.'
        ]);
    }
}
