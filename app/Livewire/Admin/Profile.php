<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Profile extends Component
{

    #region Propriedades
    #[Url(keep: true)]
    public $tab = '';
    public $name, $email, $username, $bio;
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

     #[On('updateProfile')]
    public function refreshProfile()
    {
        $user = auth()->user()->refresh();
        $this->fill($user->only(['name', 'email', 'username', 'bio']));
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
