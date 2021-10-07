function store(form) {
    // form = formulario que envia los datos
    axios(form.attr('action'), {
        method: form.attr('method'),
        data: form.serialize()
    }).then(res => {
        showMsg(res.data.title, res.data.msg, res.data.icon, true)
        $('#modalForm').modal('hide');
    }).catch(err => {
        // eliminamos los msj de errores
        $(".help-block").remove();

        let errors = err.response;
        if (errors.status === 401)
            $(location).prop('pathname', 'auth/login');
        if (errors.status === 422) {
            errors = errors.data;
            $.each(errors.errors, function (key, value) {
                $('[name="' + key + '"]')
                    .closest('.form-group')
                    .addClass('has-error')
                    .append('<span class="help-block text-danger">' + value + '</span>');
            });
        } else {
            showMsg("Ups! Hubo un error imprevisto", `Contáctate con el administrador. Error ${errors.status}`, 'error', true)
        }
    });
}

function showMsg(title, msg, icon, reload) {
    Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        showCancelButton: false,
    }).then(() => {
        if (reload) {
            // location.reload();
            console.log('deberia recargar');
        }
    });
}




export { store, showMsg };

