// #region Logo

const $inputLogo = $('#site_logo');
const $previewLogo = $('#preview_site_logo');
const $btnCancelLogo = $('#btn_cancel_logo');

// Método para retornar o preview da Logo ao original
$(document).on('click', '#btn_cancel_logo', function () {
    const originalImage = $previewLogo.attr('data-default-src');

    $previewLogo.attr('src', originalImage); // Volta para a imagem original

    $inputLogo.val(''); // Limpa o input de arquivo

    $(this).addClass('d-none'); // Esconde o botão de cancelar
});

// Método para receber e validar a imagem de logo
$inputLogo.on('change', function () {
    const imageFile = this.files[0];
    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    const originalImage = $previewLogo.attr('data-default-src');

    if (imageFile) {
        if (!allowedTypes.includes(imageFile.type)) {
            alert('Invalid file type. Only PNG and JPG are allowed.');
            $(this).val('');
            $previewLogo.attr('src', originalImage);
            $btnCancelLogo.addClass('d-none');
            return;
        }

        const objectUrl = URL.createObjectURL(imageFile);
        $previewLogo.attr('src', objectUrl);
        $btnCancelLogo.removeClass('d-none');
    } else {
        $previewLogo.attr('src', originalImage);
        $btnCancelLogo.addClass('d-none');
    }
});

// Método para enviar a imagem de logo validada para o backend
$('#updateLogoForm').on('submit', function (event) {
    event.preventDefault();

    const $form = $(this);
    const $btnSubmit = $form.find('button[type="submit"]');
    const inputVal = $('#site_logo').val();
    const errorElement = $form.find('.text-danger');

    if (inputVal.length > 0) {
        errorElement.text('');
        $btnSubmit.prop('disabled', true).text('Sending...');

        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: new FormData($form[0]),
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: { 'Accept': 'application/json' }
        })
        .done(function (response) {
            $form[0].reset();
            const newLogoPath = '/' + response.image_path;

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
        .fail(function (xhr) {
            console.error('Request error:', xhr.responseText);

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
        .always(function () {
            $btnSubmit.prop('disabled', false).text('Change Logo');
        });
    } else {
        errorElement.text('Please, select an image file.');
    }
});

// #endregion
