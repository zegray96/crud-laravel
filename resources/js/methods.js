function store(form, tableId) {
    // form = formulario que envia los datos
    axios(form.attr('action'), {
        method: form.attr('method'),
        data: form.serialize()
    }).then(res => {
        refreshDataTable(tableId);
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
    })
}

function confirmMsg(title, msg, icon) {
    return Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            return true;
        } else {
            return false;
        }
    });
}

function destroy(href, tableId) {
    confirmMsg("¿Estás seguro/a?", "Se eliminará el registro", 'warning')
        .then(res => {
            if (res) {
                axios.delete(href)
                    .then(res => {
                        refreshDataTable(tableId);
                        showMsg(res.data.title, res.data.msg, res.data.icon, false);
                    });
            }
        })
}


function create(url) {
    axios.get(url)
        .then(res => {
            $('#modalFormContent').html(res.data);
            // evitamos que al hacer click se cierre el modal
            $('#modalForm').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
        }).catch(err => console.log)
}



function refreshDataTable(tableId) {
    tableId.DataTable().ajax.reload();
}




export { store, destroy, create, showMsg, confirmMsg, refreshDataTable };

