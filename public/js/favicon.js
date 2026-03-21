// #region Favicon

const $inputFavicon = $('#site_favicon');
const $previewFavicon = $('#preview_site_favicon');
const $btnCancelFavicon = $('#btn_cancel_favicon');

// Método para retornar o preview do Favicon ao original
$(document).on('click', '#btn_cancel_favicon', function () {
    const originalImage = $previewFavicon.attr('data-default-src');

    $previewFavicon.attr('src', originalImage); // Volta para a imagem original

    $inputFavicon.val(''); // Limpa o input de arquivo

    $(this).addClass('d-none'); // Esconde o botão de cancelar
});

// Método para receber e validar a imagem de favicon
$inputFavicon.on('change', function () {
    const imageFile = this.files[0];
    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    const originalImage = $previewFavicon.attr('data-default-src');

    if (imageFile) {
        if (!allowedTypes.includes(imageFile.type)) {
            alert('Invalid file type. Only PNG and JPG are allowed.');
            $(this).val('');
            $previewFavicon.attr('src', originalImage);
            $btnCancelFavicon.addClass('d-none');
            return;
        }

        const objectUrl = URL.createObjectURL(imageFile);
        $previewFavicon.attr('src', objectUrl);
        $btnCancelFavicon.removeClass('d-none');
    } else {
        $previewFavicon.attr('src', originalImage);
        $btnCancelFavicon.addClass('d-none');
    }
});

// Método para enviar a imagem de favicon validada para o backend
$('#updateFaviconForm').on('submit', function (event) {
    event.preventDefault();

    const $form = $(this);
    const $btnSubmit = $form.find('button[type="submit"]');
    const inputVal = $('#site_favicon').val();
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
            const newFaviconPath = '/' + response.image_path;

            $('img.site_favicon').attr('src', newFaviconPath).show();

            $('#preview_site_favicon')
                .attr('src', newFaviconPath)
                .attr('data-default-src', newFaviconPath);

            $('#btn_cancel_favicon').addClass('d-none');

            Toast.fire({
                icon: 'success',
                title: response.message || 'Favicon updated successfully!',
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
            $btnSubmit.prop('disabled', false).text('Change Favicon');
        });
    } else {
        errorElement.text('Please, select an image file.');
    }
});

// #endregion
