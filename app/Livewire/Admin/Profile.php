<?php

namespace App\Livewire\Admin;

use App\Helpers\CMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Profile extends Component
{

    #region Propriedades
    #[Url(keep: true)]
    public $tab = '';
    public $name, $email, $username, $bio;
    public $current_password, $new_password, $new_password_confirmation;
    public $facebook_url,$instagram_url,$youtube_url,$linkedin_url,$x_url,$github_url, $social_links = [];
    #endregion

    public function selectTab($tabName)
    {
        $this->tab = $tabName;
    }

    public function mount()
    {
        $user = auth()->user();

        // Carrega as informações do Usuário incluindo o polimorfismo dos social_links
        $user->load('social_links');

        // Preenche os dados atuais com base nas informações do Usuário
        $this->fill($user->toArray());

        // Só define o padrão se a URL estiver vazia
        if (empty($this->tab)) {
            $this->tab = 'personal_details';
        }
    }

    #[On('updateProfile')]
    public function refreshProfile()
    {
        $user = auth()->user()->refresh();
        $this->fill($user->only(['name', 'email', 'username', 'bio']));
    }

    public function updatePassword()
    {
        $user = auth()->user();

        $validatedData = $this->validate([
            'current_password' => 'required|min:5|current_password',
            'new_password'     => 'required|min:5|confirmed',
        ]);

        $passwordUpdated = $user->update([
            'password' => Hash::make($validatedData['new_password'])
        ]);

        if ($passwordUpdated) {

            $emailData = [
                'user' => $user,
                'new_password' => $this->new_password
            ];

            $emailBody = view('email-templates.password-changes-template', $emailData)->render();

            $emailConfig = [
                'recipient_address' => $user->email,
                'recipient_name' => $user->name,
                'subject' => 'Password Changed',
                'body' => $emailBody
            ];

            CMail::send($emailConfig);

            // Limpa as informações no formulário, para não ficar na tela
            $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

            // Desloga e redireciona o User para a pagina de Login
            auth()->logout();
            Session::flash('info', 'You password have been updated successfully. Please login with your new password!');
            return $this->redirectRoute('admin.login');
        } else {
            $this->notifyToastr($passwordUpdated,"");
        }
    }

    public function updatePersonalDetails()
    {
        $user = auth()->user();

        $validatedData = $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'bio' => 'nullable|string'
        ]);

        $userUpdated = $user->update($validatedData);

        if ($userUpdated) {
            $this->dispatch(
                'showToastr',
                type: 'success',
                message: 'Your personal details have been updated successfully.'
            );
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        } else {
            $this->dispatch(
                'showToastr',
                type: 'error',
                message: 'Something went wrong.'
            );
        }
    }
    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => auth()->user()
        ]);
    }
}
