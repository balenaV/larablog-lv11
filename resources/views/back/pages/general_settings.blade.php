@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Settings</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Settings
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mb-4">
        @livewire('admin.settings')
    </div>
@endsection
@push('scripts')
    <script>
        const $inputLogo = $('#site_logo');
        const $preview = $('#preview_site_logo');
        const $btnCancel = $('#btn_cancel_logo');

        // Método para retornar o preview da Logo ao original
       $(document).on('click', '#btn_cancel_logo', function() {
        console.log("foi clicado");
            const originalImage = $preview.attr('data-default-src');

            $preview.attr('src', originalImage); // Volta para a imgem original

            $inputLogo.val(''); // Limpa o input de arquivo

            $(this).addClass('d-none'); // Esconde o botão de cancelar
        });

        // Método para receber e validar a imagem de logo/favicon
        $inputLogo.on('change', function() {
            const imageFile = this.files[0];
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            const originalImage = $preview.attr('data-default-src');

            if (imageFile) {
                if (!allowedTypes.includes(imageFile.type)) {
                    alert('Invalid file type. Only PNG and JPG are allowed.');
                    $(this).val('');
                    $preview.attr('src', originalImage); // Retorna ao padrão
                    $btnCancel.addClass('d-none'); // Garante que o botão fique escondido
                    return;
                }

                // Gera o preview novo
                const objectUrl = URL.createObjectURL(imageFile);
                $preview.attr('src', objectUrl);

                $btnCancel.removeClass('d-none');
            } else {
                $preview.attr('src', originalImage);
                $btnCancel.addClass('d-none');
            }
        });

        // Método para enviar a imagem de logo/favicon validada para o backend
        $('#updateLogoForm').on('submit', function(event) {

            event.preventDefault();

            const $form = $(this);
            const $btnSubmit = $form.find('button[type="submit"]');
            const inputVal = $('#site_logo').val();
            const errorElement = $form.find('.text-danger');

            // Valida se uma Imagem foi escolhida
            if (inputVal.length > 0) {
                errorElement.text(''); // Limpa mensagens de erro antigas
                $btnSubmit.prop('disabled', true).text('Sending...');

                $.ajax({
                        url: $form.attr('action'),
                        method: $form.attr('method'),
                        data: new FormData($form[0]),
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .done(function(response) {
                        $form[0].reset();
                        const newLogoPath = '/' + response.image_p;

                        $('img.site_logo').attr('src', newLogoPath).show();

                        $('#preview_site_logo')
                            .attr('src', newLogoPath)
                            .attr('data-default-src', newLogoPath);

                        $('#btn_cancel_logo').addClass('d-none');

                        Toast.fire({
                            icon: 'success',
                            title: response.message || 'Logo updated successfully!',
                            background: '#22c55e'
                        });
                    })
                    .fail(function(xhr) {
                        console.error("Request error:", xhr.responseText);

                        let errorMessage = 'Something went wrong.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors)[0][0];
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Toast.fire({
                            icon: 'error',
                            title: errorMessage,
                            background: '#ef4444'
                        });
                    })
                    .always(function() {
                        $btnSubmit.prop('disabled', false).text('Change Logo');
                    });

            } else {
                // Mostra o erro se o usuário tentar enviar vazio
                errorElement.text('Please, select an image file.');
            }
        });
    </script>
@endpush
