@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @livewire('admin.profile')
@endsection
@push('scripts')
    <script>
        const cropper = new Kropify('input[type="file"][id="profilePictureFile"]', {
            aspectRatio: 1,
            viewMode: 1,
            preview: 'image#profilePicturePreview',
            processURL: '{{ route('admin.update_profile_picture') }}', // or processURL:'/crop'
            maxSize: 2 * 1024 * 1024, // 2MB
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            showLoader: true,
            animationClass: 'pulse',
            // fileName: 'avatar', // leave this commented if you want it to default to the input name
            cancelButtonText: 'Cancel',
            resetButtonText: 'Reset',
            cropButtonText: 'Crop & Upload',
            maxWoH: 500,
            onError: function(msg) {
                Toast.fire({
                    icon: 'error',
                    title: msg,
                    background: '#ef4444' // Vermelho
                });
            },
            onDone: function(data) {
                // Verifica se o status do PHP é 1 (Sucesso)
                const isSuccess = data.status == 1;

                // Dispara a notificação verde (sucesso) ou vermelha (erro) vinda do PHP
                Toast.fire({
                    icon: isSuccess ? 'success' : 'error',
                    title: data.message, // Puxa a mensagem do seu Controller PHP
                    background: isSuccess ? '#22c55e' : '#ef4444'
                });

                if (isSuccess) {
                    Livewire.dispatch('updateTopUserInfo');
                    Livewire.dispatch('updateProfile');
                }
            }
        });
    </script>
@endpush
