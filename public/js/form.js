$(function () {
    bsCustomFileInput.init();

    // Actualiza el nombre del archivo cuando se selecciona una nueva imagen
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });
});

// BASE64 IMG
$('.custom-file-input').on('change', function(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = (event) => {
        var element = $(this).parent('.custom-file').siblings('figure').find('img');
        element.attr('src', event.target.result);
        element.removeClass('d-none');
    }
    reader.readAsDataURL(file);
});

// Eliminar imágenes y restablecer la vista previa
$('#delete-imagen2').on('click', function() {
    $('#imagen2_eliminar').val('1');
    $('#imagen2').val('');
    $('#label-imagen2').text('Imagen 2');
    $('#preview-imagen2').attr('src', defaultImage).removeClass('d-none');
});
$('#delete-imagen3').on('click', function() {
    $('#imagen3_eliminar').val('1');
    $('#imagen3').val('');
    $('#label-imagen3').text('Imagen 3');
    $('#preview-imagen3').attr('src', defaultImage).removeClass('d-none');
});
$('#delete-imagen4').on('click', function() {
    $('#imagen4_eliminar').val('1');
    $('#imagen4').val('');
    $('#label-imagen4').text('Imagen 4');
    $('#preview-imagen4').attr('src', defaultImage).removeClass('d-none');
});
$('#delete-imagen5').on('click', function() {
    $('#imagen5_eliminar').val('1');
    $('#imagen5').val('');
    $('#label-imagen5').text('Imagen 5');
    $('#preview-imagen5').attr('src', defaultImage).removeClass('d-none');
});

// Selectores de categoría y subcategoría
$(document).ready(function() {
    var categoria = $('#categoria');
    var subcategorias = $('#subcategoria option');

    function filtrarSubcategorias() {
        var categoriaId = categoria.val();
        $('#subcategoria').val('');
        subcategorias.each(function() {
            var subcategoria = $(this);
            if (subcategoria.data('categoria') == categoriaId) {
                subcategoria.show();
            } else {
                subcategoria.hide();
            }
        });
    }

    categoria.change(filtrarSubcategorias);
    filtrarSubcategorias();
});
