<div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                    <img src="{{ $user->picture }}" alt="" class="avatar-photo">
                </div>
                <h5 class="text-center h5 mb-0">{{ $user->name }}</h5>
                <p class="text-center text-muted font-14">
                    {{ $user->email }}
                </p>
                <div class="profile-social">
                    <h5 class="mb-20 h5 text-blue">Social Links</h5>
                    <ul class="clearfix">
                        <li>
                            <a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);"><i
                                    class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);"><i
                                    class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i
                                    class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i
                                    class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);"><i
                                    class="fa fa-dribbble"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);"><i
                                    class="fa fa-dropbox"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);"><i
                                    class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);"><i
                                    class="fa fa-pinterest-p"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);"><i
                                    class="fa fa-skype"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"
                                style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);"><i
                                    class="fa fa-vine"></i></a>
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
                                <a wire:click="selectTab('personal_details')"
                                    class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" data-toggle="tab"
                                    href="#personal_details" role="tab">Personal details</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click="selectTab('update_password')"
                                    class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}" data-toggle="tab"
                                    href="#update_password" role="tab">Update password</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click="selectTab('social_links')"
                                    class="nav-link {{ $tab == 'social_links' ? 'active' : '' }}" data-toggle="tab"
                                    href="#social_links" role="tab">Social Links</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Tab start -->
                            <div class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}"
                                id="personal_details" role="tabpanel">
                                <div class="pd-20">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Full name</label>
                                                    <input type="text" class="form-control" wire:model="name"
                                                        placeholder="Enter full name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" class="form-control" wire:model="email"
                                                        placeholder="Enter email address">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Username</label>
                                                    <input type="text" class="form-control" wire:model="username"
                                                        placeholder="Enter username">
                                                    @error('username')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Bio</label>
                                                    <textarea class="form-control" wire:model="bio" cols="4" rows="4" placeholder="Type your bio..."></textarea>
                                                    @error('bio')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><button type="submit" class="btn btn-primary">Save
                                                changes</button></div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}"
                                id="update_password" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    ---- Update Password ----
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $tab == 'social_links' ? 'show active' : '' }}"
                                id="social_links" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    ---- Social Links ----
                                </div>
                            </div>
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
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control form-control-lg" type="email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Date of birth</label>
                                                    <input class="form-control form-control-lg date-picker"
                                                        type="text">
                                                </div>
                                                <div class="form-group">
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
                                                <div class="form-group">
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
                                                <div class="form-group">
                                                    <label>State/Province/Region</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Visa Card Number</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Paypal ID</label>
                                                    <input class="form-control form-control-lg" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1-1">
                                                        <label class="custom-control-label weight-400"
                                                            for="customCheck1-1">I agree to receive notification
                                                            emails</label>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Update Information">
                                                </div>
                                            </li>
                                            <li class="weight-500 col-md-6">
                                                <h4 class="text-blue h5 mb-20">
                                                    Edit Social Media links
                                                </h4>
                                                <div class="form-group">
                                                    <label>Facebook URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Twitter URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Linkedin URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Instagram URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Dribbble URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Dropbox URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Google-plus URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pinterest URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Skype URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Vine URL:</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group mb-0">
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
