<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
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
        ], [
            'profilePictureFile.required' => 'The profile picture is required.',
            'profilePictureFile.image'    => 'The file must be an image.',
            'profilePictureFile.mimes'    => 'Wrong format! Accepted formats: jpeg, png, jpg ou gif.',
            'profilePictureFile.max'      => 'The image must not exceed 2MB.',
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
                'message' => 'Your profile picture have been updated successfully!'
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Something went wrong'
        ]);
    }
    public function generalSettings(Request $request)
    {
        try {
            $data = [
                'pageTitle' => 'General settings'
            ];

            return view('back.pages.general_settings', $data);
        } catch (Throwable $e) {
            Log::error("Erro ao carregar a página de configuração geral: " . $e->getMessage());

            return redirect()->route('admin.dashboard')->with('error', 'Erro ao abrir configuração geral.');
        }
    }

    public function updateLogo(Request $request)
    {
        $settings = GeneralSetting::first();

        if (!$settings) {
            return response()->json([
                'status' => 0,
                'message' => 'Make sure you updated general settings form first.'
            ], 400); // Bad request
        }

        if (!$request->hasFile('site_logo') || !$request->file('site_logo')->isValid()) {
            return response()->json([
                'status' => 0,
                'message' => 'No valid image file received.'
            ], 400); // Bad request
        }

        try {
            $path = 'images/site/';
            $file = $request->file('site_logo');

            // Pega a extensão real do arquivo
            $extension = $file->getClientOriginalExtension();
            $filename = 'logo_' . uniqid() . '.' . $extension;

            // Faz o upload
            $file->move(public_path($path), $filename);

            // Remove a imagem antiga se existir
            $old_logo = $settings->site_logo;
            if (!empty($old_logo) && File::exists(public_path($path . $old_logo))) {
                File::delete(public_path($path . $old_logo));
            }

            $settings->update(['site_logo' => $filename]);

            return response()->json([
                'status' => 1,
                'image_path' => $path . $filename,
                'message' => 'Site logo has been updated successfully.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar logo: ' . $e->getMessage());

            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong in uploading new logo.'
            ], 500);
        }
    }
}
