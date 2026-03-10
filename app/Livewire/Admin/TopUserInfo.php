<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Component;

class TopUserInfo extends Component
{
    #[On('updateTopUserInfo')]
    public function refreshTopUserInfo()
    {
        auth()->user()->refresh();
    }

    public function render()
    {
        return view('livewire.admin.top-user-info',[
            'user' => auth()->user()
        ]);
    }
}
