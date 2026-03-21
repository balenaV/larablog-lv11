<div>
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click="$set('tab', 'general_settings')"
                    class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-toggle="tab"
                    href="#general_settings" role="tab" aria-selected="false">General settings</a>
            </li>
            <li class="nav-item">
                <a wire:click="$set('tab', 'logo_favicon')"
                    class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}" data-toggle="tab" href="#logo_favicon"
                    role="tab" aria-selected="false">Logo &
                    Favicon</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ $tab == 'general_settings' ? 'active show' : '' }}" id="general_settings"
                role="tabpanel">
                <div class="pd-20">
                    <form wire:submit='updateSiteInfo()'>
                        <div class="row">
                            {{-- Site title start --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for=""><b>Site title</b></label>
                                    <input type="text" class="form-control" wire:model='site_title' id=""
                                        placeholder="Enter site title">
                                    @error('site_title')
                                        <span class="text-danger ms-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Site email start --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for=""><b>Site email</b></label>
                                    <input type="text" class="form-control" wire:model='site_email' id=""
                                        placeholder="Enter site email">
                                    @error('site_email')
                                        <span class="text-danger ms-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Site phone (optional) start --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for=""><b>Site phone number</b><small> (Optional)</small></label>
                                    <input type="text" class="form-control" wire:model='site_phone' id=""
                                        placeholder="Enter site contact phone">
                                    @error('site_phone')
                                        <span class="text-danger ms-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Site Meta Keywords start --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for=""><b>Site Meta Keywords</b></label>
                                    <input type="text" class="form-control" wire:model='site_meta_keywords'
                                        id="" placeholder="Eg: ecommerce, free api, laravel">
                                    @error('site_meta_keywords')
                                        <span class="text-danger ms-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for=""><b>Site Meta Description</b><small> (Optional)</small></label>
                            <textarea cols="4" rows="4" wire:model='site_meta_description' class="form-control"
                                placeholder="Type site meta description..."></textarea>
                            @error('site_meta_description')
                                <div class="text-danger ms-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'active show' : '' }}" id="logo_favicon"
                role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        {{-- Site Logo --}}
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <h6>Site Logo</h6>

                            <div class="position-relative mb-3" style="width: 200px; height: 120px;">
                                <img wire:ignore
                                    src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}"
                                    data-default-src="/images/site/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}"
                                    id="preview_site_logo" alt="Site Logo" class="img-thumbnail w-100 h-100"
                                    style="object-fit: contain; background-color: #f8f9fa;">

                                <button type="button" id="btn_cancel_logo"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 d-none"
                                    title="Cancelar alteração">X</button>
                            </div>

                            <form action="{{ route('admin.update_logo') }}" method="post"
                                enctype="multipart/form-data" id="updateLogoForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" class="form-control" name="site_logo" id="site_logo">
                                    <span class="text-danger ms-1"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Logo</button>
                            </form>
                        </div>

                        {{-- Site Favicon --}}
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <h6>Site Favicon</h6>

                            <div class="position-relative mb-3" style="width: 120px; height: 120px;">
                                <img wire:ignore
                                    src="/images/site/{{ isset(settings()->site_favicon) ? settings()->site_favicon : '' }}"
                                    data-default-src="/images/site/{{ isset(settings()->site_favicon) ? settings()->site_favicon : '' }}"
                                    id="preview_site_favicon" alt="Site Favicon" class="img-thumbnail w-100 h-100"
                                    style="object-fit: contain; background-color: #f8f9fa;">

                                <button type="button" id="btn_cancel_favicon"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 d-none"
                                    title="Cancelar alteração">X</button>
                            </div>

                            <form action="{{ route('admin.update_favicon') }}" method="post"
                                enctype="multipart/form-data" id="updateFaviconForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" class="form-control" name="site_favicon"
                                        id="site_favicon">
                                    <span class="text-danger ms-1"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Favicon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
