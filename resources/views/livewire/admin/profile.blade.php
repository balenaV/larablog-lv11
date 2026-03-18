<div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="javascript:;"
                        onclick="event.preventDefault();document.getElementById('profilePictureFile').click();"
                        class="edit-avatar"><i class="fa fa-pencil"></i></a>
                    <img src="{{ $user->picture }}" alt="" class="avatar-photo" id="profilePicturePreview">
                    <input type="file" name="profilePictureFile" id="profilePictureFile" class="d-none"
                        style="opacity: 0">
                </div>
                <h5 class="text-center h5 mb-0">{{ $user->name }}</h5>
                <p class="text-center text-muted font-14">
                    {{ $user->email }}
                </p>
                <div class="profile-social">
                    <h5 class="mb-20 h5 text-blue">Social Links</h5>
                    <ul class="clearfix">
                        <li>
                            <a href="{{ $user->social_links->facebook_url }}" class="btn" target="_blank" data-bgcolor="#3b5998" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);"><i
                                    class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="{{ $user->social_links->x_url }}" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" target="_blank"
                                style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);"><i
                                    class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{ $user->social_links->linkedin_url }}" class="btn" target="_blank" data-bgcolor="#007bb5" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i
                                    class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="{{ $user->social_links->instagram_url }}" class="btn" target="_blank" data-bgcolor="#f46f30" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i
                                    class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{ $user->social_links->youtube_url }}" class="btn" target="_blank" data-bgcolor="#c60000" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: #c60000;"><i
                                    class="fa fa-youtube"></i></a>
                        </li>
                         <li>
                            <a href="{{ $user->social_links->github_url }}" class="btn" target="_blank" data-bgcolor="#363535" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: #363535;"><i
                                    class="fa fa-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:click="$set('tab', 'personal_details')"
                                    class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" data-toggle="tab"
                                    href="#personal_details" role="tab">Personal details</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click="$set('tab', 'update_password')"
                                    class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}" data-toggle="tab"
                                    href="#update_password" role="tab">Update password</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click="$set('tab', 'social_links')"
                                    class="nav-link {{ $tab == 'social_links' ? 'active' : '' }}" data-toggle="tab"
                                    href="#social_links" role="tab">Social Links</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Tabs start -->
                            {{-- Personal Details Tab Start --}}
                            <div class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}"
                                id="personal_details" role="tabpanel">
                                <div class="pd-20">
                                    <form wire:submit="updatePersonalDetails()">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="">Full name</label>
                                                    <input type="text" class="form-control" wire:model="name"
                                                        placeholder="Enter full name">
                                                    @error('name')
                                                        <span class="text-danger ms-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="">Email</label>
                                                    <input type="text" class="form-control" wire:model="email"
                                                        placeholder="Enter email address" disabled>
                                                    @error('email')
                                                        <span class="text-danger ms-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="">Username</label>
                                                    <input type="text" class="form-control" wire:model="username"
                                                        placeholder="Enter username">
                                                    @error('username')
                                                        <span class="text-danger ms-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="">Bio</label>
                                                    <textarea class="form-control" wire:model="bio" cols="4" rows="4" placeholder="Type your bio..."></textarea>
                                                    @error('bio')
                                                        <span class="text-danger ms-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-end"><button type="submit"
                                                class="btn btn-primary"><span wire:loading.remove>Save Changes</span>
                                                <span wire:loading>Saving... wait</span></button></div>
                                    </form>
                                </div>
                            </div>
                            {{-- Personal Details Tab End --}}
                            {{-- Update Password Tab Start --}}
                            <div class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}"
                                id="update_password" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    <form wire:submit='updatePassword()'>
                                        <div class="row">
                                            {{-- Senha atual --}}
                                            <div class="col-12">
                                                <div class="mb-3"><label for="">Current password</label>
                                                    <input type="password" class="form-control"
                                                        wire:model='current_password'
                                                        placeholder="Enter current password">
                                                    @error('current_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Nova senha --}}
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3"><label for="">New password</label>
                                                    <input type="password" class="form-control"
                                                        wire:model='new_password' placeholder="Enter new password">
                                                    @error('new_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Confirmar nova senha --}}
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3"><label for="">Confirm new password</label>
                                                    <input type="password" class="form-control"
                                                        wire:model='new_password_confirmation'
                                                        placeholder="Confirm new password">
                                                    @error('new_password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-end"><button type="submit"
                                                class="btn btn-primary"><span wire:loading.remove>Update
                                                    password</span>
                                                <span wire:loading>Updating... wait</span></button></div>
                                    </form>
                                </div>
                            </div>
                            {{-- Update Password Tab End --}}
                            {{-- Social Links Tab Start --}}
                            <div class="tab-pane fade {{ $tab == 'social_links' ? 'show active' : '' }}"
                                id="social_links" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    <form method="POST" wire:submit.prevent="updateSocialLinks">
                                        <div class="row">
                                            {{-- Facebook start --}}
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Facebook</b></label>
                                                    <input type="text" class="form-control" wire:model='social_links.facebook_url'
                                                    placeholder="Facebook Url">
                                                    @error('social_links.facebook_url')
                                                    <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Instagram start --}}
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Instagram</b></label>
                                                    <input type="text" class="form-control" wire:model='social_links.instagram_url'
                                                    placeholder="Instagram Url">
                                                    @error('social_links.instagram_url')
                                                    <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- YouTube start --}}
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>YouTube</b></label>
                                                    <input type="text" class="form-control" wire:model='social_links.youtube_url'
                                                    placeholder="YouTube Url">
                                                    @error('social_links.youtube_url')
                                                    <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- LinkedIn start --}}
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>LinkedIn</b></label>
                                                    <input type="text" class="form-control" wire:model='social_links.linkedin_url'
                                                    placeholder="LinkedIn Url">
                                                    @error('social_links.linkedin_url')
                                                    <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- X(Twitter) start --}}
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>X</b></label>
                                                    <input type="text" class="form-control" wire:model='social_links.x_url'
                                                    placeholder="X Url">
                                                    @error('social_links.x_url')
                                                    <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- GitHub start --}}
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>GitHub</b></label>
                                                    <input type="text" class="form-control" wire:model='social_links.github_url'
                                                    placeholder="GitHub Url">
                                                    @error('social_links.github_url')
                                                    <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Social Links Tab End --}}
                            <!-- Tasks Tab End -->
                            <!-- Setting Tab start -->
                            <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                <div class="profile-setting">
                                    <form>
                                        <ul class="profile-edit-list row">
                                            <li class="weight-500 col-md-6">
                                                <h4 class="text-blue h5 mb-20">
                                                    Edit Your Personal Setting
                                                </h4>
                                                <div class="mb-3">
                                                    <label>Full Name</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Title</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input class="form-control form-control-lg" type="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Date of birth</label>
                                                    <input class="form-control form-control-lg date-picker"
                                                        type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Gender</label>
                                                    <div class="d-flex">
                                                        <div class="custom-control custom-radio mb-5 mr-20">
                                                            <input type="radio" id="customRadio4"
                                                                name="customRadio" class="custom-control-input">
                                                            <label class="custom-control-label weight-400"
                                                                for="customRadio4">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" id="customRadio5"
                                                                name="customRadio" class="custom-control-input">
                                                            <label class="custom-control-label weight-400"
                                                                for="customRadio5">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Country</label>
                                                    <div
                                                        class="dropdown bootstrap-select form-control form-control-lg">
                                                        <select class="selectpicker form-control form-control-lg"
                                                            data-style="btn-outline-secondary btn-lg"
                                                            title="Not Chosen" tabindex="-98">
                                                            <option class="bs-title-option" value=""></option>
                                                            <option>United States</option>
                                                            <option>India</option>
                                                            <option>United Kingdom</option>
                                                        </select><button type="button"
                                                            class="btn dropdown-toggle btn-outline-secondary btn-lg bs-placeholder"
                                                            data-toggle="dropdown" role="combobox"
                                                            aria-owns="bs-select-3" aria-haspopup="listbox"
                                                            aria-expanded="false" title="Not Chosen">
                                                            <div class="filter-option">
                                                                <div class="filter-option-inner">
                                                                    <div class="filter-option-inner-inner">Not Chosen
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <div class="dropdown-menu ">
                                                            <div class="inner show" role="listbox" id="bs-select-3"
                                                                tabindex="-1">
                                                                <ul class="dropdown-menu inner show"
                                                                    role="presentation">
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>State/Province/Region</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Postal Code</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Phone Number</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Address</label>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Visa Card Number</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Paypal ID</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1-1">
                                                        <label class="custom-control-label weight-400"
                                                            for="customCheck1-1">I agree to receive notification
                                                            emails</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 mb-0">
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Update Information">
                                                </div>
                                            </li>
                                            <li class="weight-500 col-md-6">
                                                <h4 class="text-blue h5 mb-20">
                                                    Edit Social Media links
                                                </h4>
                                                <div class="mb-3">
                                                    <label>Facebook URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Twitter URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Linkedin URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Instagram URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Dribbble URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Dropbox URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Google-plus URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Pinterest URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Skype URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Vine URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="mb-3 mb-0">
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Save &amp; Update">
                                                </div>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <!-- Setting Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
