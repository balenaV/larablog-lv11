<?php

namespace App\Livewire\Admin;

use App\Helpers\CMail;
use App\Livewire\Traits\AlertsToastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Profile extends Component
{
    use AlertsToastr;

    #region Propriedades
    #[Url(keep: true)]
    public $tab = '';
    public $name, $email, $username, $bio;
    public $current_password, $new_password, $new_password_confirmation;
    public $social_links = [];
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

    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => auth()->user()
        ]);
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
            $this->notifyToastr($passwordUpdated, "");
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

        $this->notifyToastr($userUpdated, "Your personal details have been updated successfully.");
    }

    public function updateSocialLinks()
    {
        $user = auth()->user();

        $validatedData = $this->validate([
            'social_links.facebook_url' => 'nullable|url',
            'social_links.instagram_url' => 'nullable|url',
            'social_links.youtube_url' => 'nullable|url',
            'social_links.x_url' => 'nullable|url',
            'social_links.linkedin_url' => 'nullable|url',
            'social_links.github_url' => 'nullable|url'
        ]);

        $socialLinksUpdated = $user->social_links()->updateOrCreate(
            ['user_id' => auth()->id()],
            $validatedData['social_links']
        ); // Se o usuário ainda já houver social_links, ele atualiza, se não, cria uma

        $this->notifyToastr($socialLinksUpdated, "Your social links have been updated successfully.");
    }

    /**
     * Atribui 'apelidos' aos inputs na validação do frontend
     *
     * @return void
     */
    protected function validationAttributes()
    {
        return [
            'social_links.facebook_url' => 'Facebook URL',
            'social_links.instagram_url' => 'Instagram URL',
            'social_links.youtube_url' => 'YouTube URL',
            'social_links.linkedin_url' => 'LinkedIn URL',
            'social_links.x_url' => 'X URL',
            'social_links.github_url' => 'GitHub URL',
        ];
    }
}
