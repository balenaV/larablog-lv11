<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\Component;

class Profile extends Component
{

    #region Propriedades
    #[Url(keep: true)]
    public $tab = '';
    public $name;
    public $email;
    public $username;
    public $bio;
    #endregion

    public function selectTab($tabName)
    {
        $this->tab = $tabName;
    }

    public function mount()
    {
        $user = auth()->user();

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
}
