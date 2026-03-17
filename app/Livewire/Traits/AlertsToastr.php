<?php
namespace App\Livewire\Traits;

trait AlertsToastr
{
    /**
     * Dispara um Toastr de Sucesso ou Erro baseado em uma condição
     */
    public function notifyToastr($condition, $successMessage, $errorMessage = 'Something went wrong.')
    {
        if ($condition) {
            $this->dispatch('showToastr', type: 'success', message: $successMessage);
        } else {
            $this->dispatch('showToastr', type: 'error', message: $errorMessage);
        }
    }
}
