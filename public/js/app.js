$('document').ready(function () {

    $('.tester-form').submit(function (evt) {
        evt.preventDefault();
        const route = this.action;
        const getRoute = "{{ route('products.getajax') }}";
        const {
            name,
            value
        } = this.children[0];
        console.log({
            name,
            value
        })
        console.log({
            getRoute
        })

        $.ajax(getRoute, {
            type: 'GET',
            success: function (result) {
                const { data } = result;
                const productsBodyTable = $('.products-btable tr');
                productsBodyTable.remove();
                console.log('agregar')
                data.map(function (item) {
                    $('.products-btable').append(`
                    <tr>
                        <td>
                            ${item.name}
                        </td>
                        <td>
                            ${item.cost}
                        </td>
                        <td>
                            ${item.description}
                        </td>
                    </tr>
                    `)
                });

            },
        });

    });


    function deleteProduct(target) {
        const actionForm = target.closest('form');
        const closestRow = target.closest('tr');
        const route = actionForm.action;
        const dataToken = new FormData(actionForm)
        
        $.ajax(route, {
            type: 'delete',
            data: {_token: dataToken.get('_token')},
            success: function (result) {
                const { data } = result;
                initFlashMessage(data);
                closestRow.remove()
            },
            error:function (error){
                const { message } = JSON.parse(error.responseText);
                const textError = 'Error al eliminar el producto' ;
                initFlashMessage(message, textError)
            }
        });

        setTimeout(function () {
            $('.flash-message').addClass('none-message')
            $('.flash-message').removeClass('success')
            $('.flash-message').removeClass('alert')
        }, 2000)

    }

    function updateProduct(route) {
        
        $.ajax(route, {
            type: 'get',
            success: function (result) {
                const { data } = result;
                const productsBodyTable = $('.products-btable tr');
                console.log('Producto buscado')
            },
        });
    }

    $('.products-btable').click(function (evt) {
        evt.preventDefault();
        if(evt.target.nodeName != 'BUTTON')
            return;
        const {target} = evt;
       
        if (evt.target.classList.contains('action-update'))
            console.log('updat')

        if (evt.target.classList.contains('action-delete'))
            deleteProduct(target);

    });

});

function initFlashMessage(message, error = undefined){
         
    const flashMessage = $('.flash-message');
    const flashTitle = $('.flash-title h2');
    const flashContent = $('.flash-content');
    flashMessage.toggleClass('none-message');
    console.log(error)
    if(error){
        flashMessage.toggleClass('alert');
        flashTitle.html(document.createTextNode(message));
        flashContent.html(document.createTextNode(error));
        return;
    }

    flashMessage.toggleClass('success');
    flashTitle.html(document.createTextNode('Accion exitosa'));
    flashContent.html(document.createTextNode(message));
    
};
