$('document').ready(function () {

    function editProduct(target) {
        const actionForm = target.closest('form');
        const route = actionForm.action;
        const editRoute = `${route}/edit`;

        $.ajax(editRoute, {
            type: 'get',
            success: function (result) {
                const { data } = result;
                const productForm = $('#user-form :input');

                console.log(productForm)
                console.log('Producto buscado')
                console.log({ data })
            },
        });
    }

    function deleteProduct(target) {
        const actionForm = target.closest('form');
        const closestRow = target.closest('tr');
        const route = actionForm.action;
        const dataToken = new FormData(actionForm)

        $.ajax(route, {
            type: 'delete',
            data: { _token: dataToken.get('_token') },
            success: function (result) {
                const { data } = result;
                initFlashMessage(data);
                $('#products-table').DataTable().ajax.reload();

            },

            error: function (error) {
                const { message } = JSON.parse(error.responseText);
                const textError = 'Error al eliminar el producto';
                initFlashMessage(message, textError)
            }
        });

        setTimeout(function () {
            $('.flash-message').addClass('none-message')
            $('.flash-message').removeClass('success')
            $('.flash-message').removeClass('alert')
        }, 2000)

    }


    $('.products-btable').click(function (evt) {
        if (evt.target.nodeName != 'BUTTON')
            return;
        evt.preventDefault();

        const { target } = evt;

        if (evt.target.classList.contains('action-update'))
            editProduct(target)

        if (!evt.target.classList.contains('action-delete'))
            return;

        if (!window.confirm('Desea eliminar este registro?'))
            return;
        deleteProduct(target);

    });

    $('.purchase-form').submit(function (evt) {
        evt.preventDefault();
        const purchaseForm = this;
        const { action: route } = purchaseForm;
        const data = new FormData(this);
        console.debug({ id: data.get('product_id'), route })

        $.ajax(route, {
            type: 'post',
            data,
            processData: false,
            contentType: false,
            success: function (result) {
                const { data } = result;
                initFlashMessage(data);
            },

            error: function (error) {
                const { message, errors } = JSON.parse(error.responseText);
                console.log(errors)
                const textError = !!errors && errors.length == 1 ? errors[0] : 'Error al registrar la compra';
                initFlashMessage(message, textError)
            },

            complete: function () {
                setTimeout(function () {
                    $('.flash-message').addClass('none-message')
                    $('.flash-message').removeClass('success')
                    $('.flash-message').removeClass('alert')
                }, 2000)
            }
        });


    });

    

    // inicializar tabla de productos
    const invoicesTable = $('#invoices-table').DataTable({
        paging: true,
        pagingType: "simple",
        info: false,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        ajax: "invoices/table",
        columns: [{
            data: "user.name"
        },
        {
            data: "total"
        },
        {
            data: "total_tax"
        },
        {
            data: "invoice_date"
        },
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return `
                        <td id="actions-row">
                                                            
                            <a href="invoices/${data}" class="action-table action-bill" >
                                desglosar
                            </a>

                        </td>
                
                        `;
            },
        }

        ]
    });

    // evento para facturar clientes pendiente
    $('#invoice-form').submit(function(evt){
        evt.preventDefault();    
        const purchaseForm = this;
        const data = new FormData(purchaseForm);
        const { action: route } = purchaseForm;

        $.ajax(route, {
            type: 'post',
            data,
            processData: false,
            contentType: false,
            success: function (result) {
                const { data: {message} } = result;
                initFlashMessage(message);
                invoicesTable.ajax.reload();
            },

            error: function (error) {
                const { message, errors } = JSON.parse(error.responseText);
                console.log(errors)
                const textError = !!errors && errors.length == 1 ? errors[0] : 'Error al emitir la facturas';
                initFlashMessage(message, textError)
            },

            complete: function () {
                setTimeout(function () {
                    $('.flash-message').addClass('none-message')
                    $('.flash-message').removeClass('success')
                    $('.flash-message').removeClass('alert')
                }, 2000)
            }
        });
    });

});

function initFlashMessage(message, error = undefined) {

    const flashMessage = $('.flash-message');
    const flashTitle = $('.flash-title h2');
    const flashContent = $('.flash-content');
    flashMessage.toggleClass('none-message');
    console.log(error)
    if (error) {
        flashMessage.toggleClass('alert');
        flashTitle.html(document.createTextNode(message));
        flashContent.html(document.createTextNode(error));
        return;
    }

    flashMessage.toggleClass('success');
    flashTitle.html(document.createTextNode('Accion exitosa'));
    flashContent.html(document.createTextNode(message));

};


function resetIfEmpty() {
    const children = $('.products-btable').children();
    if (children.hasClass('empty-table'))
        children.remove();
}

