function store(form, tableId) {
    // form = formulario que envia los datos

    // usamos esta forma para evitar errores de carga de archivos
    let formData = new FormData(form[0]);

    // $.ajax({
    //     type: form.attr('method'),
    //     url: form.attr('action'),
    //     data: data,
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     contentType: false,
    //     processData: false,
    //     cache: false,
    //     success: function (data) {
    //         console.log(data);
    //     },
    //     error: function (error) {
    //         console.log(error);
    //     }
    // })

    axios(form.attr('action'), {
        method: form.attr('method'),
        data: formData,
    }).then(res => {
        refreshDataTable(tableId);
        showMsg(res.data.title, res.data.msg, res.data.icon, true)
        $('#modalForm').modal('hide');
    }).catch(err => {
        // eliminamos los msj de errores
        $(".invalid-feedback").remove();
        $(".is-invalid").removeClass("is-invalid")

        let errors = err.response;
        if (errors.status === 422) {
            errors = errors.data;
            $.each(errors.errors, function (key, value) {
                // Comprobamos si mi elemento es un select para darle otro estilo
                if ($('[name="' + key + '"]').is('select')) {
                    $('[name="' + key + '"]')
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="invalid-feedback d-block" role="alert"><strong>' + value + '</strong></span>');
                } else {
                    $('[name="' + key + '"]')
                        .addClass('is-invalid')
                        .closest('.form-group')
                        .append('<span class="invalid-feedback" role="alert"><strong>' + value + '</strong></span>');
                }
            });
        } else {
            showMsg("Ups! Hubo un error imprevisto", `Contáctate con el administrador. Error ${errors.status}`, 'error', true)
        }
    });
}

function showMsg(title, msg, icon) {
    Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        showCancelButton: false,
        allowOutsideClick: false
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
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
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
                    }).catch(err => {
                        let errors = err.response;
                        showMsg("Ups! Hubo un error imprevisto", `Contáctate con el administrador. Error ${errors.status}`, 'error', true)
                        console.log(err);
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
        }).catch(err => {
            console.log(err);
        });
}

function edit(url) {
    axios.get(url)
        .then(res => {
            $('#modalFormContent').html(res.data);
            // evitamos que al hacer click se cierre el modal
            $('#modalForm').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
        }).catch(err => {
            console.log(err);
        });
}



function refreshDataTable(tableId) {
    tableId.DataTable().ajax.reload();
}




export { store, create, edit, destroy, showMsg, confirmMsg, refreshDataTable };

