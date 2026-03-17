<?php

namespace App\Livewire\Admin;

use App\Livewire\Traits\AlertsToastr;
use App\Models\GeneralSetting;
use Livewire\Attributes\Url;
use Livewire\Component;

class Settings extends Component
{
    use AlertsToastr;

    #region Propriedades
    #[Url(keep: true)]
    public $tab = '';
    public $site_title, $site_email, $site_phone, $site_meta_keywords, $site_meta_description;
    #endregion

    public function mount()
    {
        $settings = GeneralSetting::first();

        if ($settings) {
            $this->fill($settings->toArray());
        }
        // Só define o padrão se a URL estiver vazia
        if (empty($this->tab)) {
            $this->tab = 'general_settings';
        }
    }

    public function updateSiteInfo()
    {
        $settings = GeneralSetting::first();

        $validatedData = $this->validate([
            'site_title' => 'required',
            'site_email' => 'required|email',
            'site_phone'         => 'nullable|string',
            'site_meta_keywords' => 'nullable|string',
            'site_meta_description' => 'nullable|string',
        ]);

        $updatedSettings = $settings->update($validatedData);

        $this->notifyToastr($updatedSettings, "The settings have been updated successfully!");
    }
    public function render()
    {
        return view('livewire.admin.settings');
    }
}
