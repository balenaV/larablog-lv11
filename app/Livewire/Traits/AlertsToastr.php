<?php
namespace App\Livewire\Traits;

trait AlertsToastr
{
    /**
     * Dispara um evento de notificação (Toastr) para o frontend via Livewire.
     *
     * @param  bool|mixed  $condition       A condição ou resultado da operação (ex: result de um update).
     * @param  string      $successMessage  Mensagem exibida caso a condição seja verdadeira.
     * @param  string      $errorMessage    Mensagem exibida caso a condição seja falsa (opcional).
     * * @return void
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
