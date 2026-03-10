<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class TopUserInfo extends Component
{
    protected $listeners = [
        'updateTopUserInfo'=>'$refresh'
    ];

    public function render()
    {
        return view('livewire.admin.top-user-info',[
            'user' => auth()->user()
        ]);
    }
}
