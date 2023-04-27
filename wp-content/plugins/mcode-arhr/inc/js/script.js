(function ($) {

    $(document).ready(function (e) {

        // Открыть диалог для нового элемента
        $('.mcode-arhr .add-item').on('click', function (event) {
            canselEditor($('table.item-data', $('.item-dialog.visibility')));
            $('.item-dialog.visibility').removeClass('visibility');
            $(`#item-dialog-0`).addClass('visibility');
            event.preventDefault();
        });

        // Закрыть диалог без сохранения
        $('.mcode-arhr .button-cansel').on('click', function (event) {
            canselEditor($(this).parents('table.item-data'));
            $(`.item-dialog`).removeClass('visibility');
            event.preventDefault();
        });

        // Сохранить
        $('.mcode-arhr .button-ok').on('click', function (event) {
            saveItem($(this).parents('.item-dialog'));
            event.preventDefault();
        });

        // Изменить
        $('.mcode-arhr .row-actions .edit a').on('click', function (event) {
            canselEditor($('table.item-data', $('.item-dialog.visibility')));
            $('.item-dialog.visibility').removeClass('visibility');
            $(`#item-dialog-${$(this).data('id')}`).addClass('visibility');
            event.preventDefault();
        });

        // Удалить
        $('.mcode-arhr .row-actions .delete a').on('click', function (event) {
            deleteItem($(`#item-dialog-${$(this).data('id')}`), $(this).parents('tr.short-item-data'));
            event.preventDefault();
        });

        $('.mcode-arhr .add-image').on('click', function (event) {
            selectImage($(this));
            event.preventDefault();
        });

        $('.mcode-arhr .delete-image').on('click', function (event) {
            deleteImage($(this));
            event.preventDefault();
        });

        // Активировать
        $('.mcode-arhr .activate a').on('click', function (event) {
            activateItem($(`#item-dialog-${$(this).data('id')}`), $(this).parents('tr.short-item-data'));
            event.preventDefault();
        });

        // Деактивировать
        $('.mcode-arhr .deactivate a').on('click', function (event) {
            deactivateItem($(`#item-dialog-${$(this).data('id')}`), $(this).parents('tr.short-item-data'));
            event.preventDefault();
        });

    });

    /**
     * Сохранить изменения
     * @param $dialog
     */
    function saveItem($dialog)
    {

        const table = $('.mcode-arhr input[name="table"]').val();

        let data = { action: `arhr_${table}_insert` };
        $('.item-field', $dialog).each(function() {
            data[$(this).attr('name')] = $(this).val();
        });
        if (parseInt($('input[name="id"]', $dialog).val(), 10) !== 0) {
            data['id'] = $('input[name="id"]', $dialog).val();
            data['action'] = `arhr_${table}_update`;
        }
        $('.mcode-arhr .notice').hide(300);

        $.post(
            ajaxurl, data,
            function (result) {
                if (result['status'] === 'error') {
                    $('.mcode-arhr .notice.error p').html(`Ошибка: ${result['result']}`);
                    $('.mcode-arhr .notice.error').show(300);
                    setTimeout(function () { $('.mcode-arhr .notice').hide(300) }, 3000);
                } else {
                    document.location.reload(true);
                }
            }, 'json'
        );
    }

    /**
     * Удалить элемент
     * @param $parent
     * @param $tr
     */
    function deleteItem($parent, $tr)
    {

        const table = $('.mcode-arhr input[name="table"]').val();

        const data = {
            id: $('input[name="id"]', $parent).val(),
            action: `arhr_${table}_delete`,
        };

        if (confirm(`Вы уверены, что хотите удалить запись?`)) {

            $.post(
                ajaxurl, data,
                function (result) {
                    if (result['status'] === 'error') {
                        $('.mcode-arhr .notice.error p').html(`Ошибка: ${result['result']}`);
                        $('.mcode-arhr .notice.error').show(300);
                        setTimeout(function () { $('.mcode-arhr .notice').hide(300) }, 3000);
                    } else {
                        document.location.reload(true);
                    }
                }, 'json'
            );

        } else {

            $('.mcode-arhr .notice.error p').html(`Запрос на удаление отменён пользователем`);
            $('.mcode-arhr .notice.error').show(300);
            setTimeout(function () { $('.mcode-arhr .notice').hide(300) }, 3000);

        }


    }

    /**
     * Активировать
     *
     * @param $parent
     * @param $tr
     */
    function activateItem($parent, $tr)
    {
        const table = $('.mcode-arhr input[name="table"]').val();

        const data = {
            id: $('input[name="id"]', $parent).val(),
            action: `arhr_${table}_activate`,
        };

        $.post(
            ajaxurl, data,
            function (result) {
                if (result['status'] === 'error') {
                    $('.mcode-arhr .notice.error p').html(`Ошибка: ${result['result']}`);
                    $('.mcode-arhr .notice.error').show(300);
                    setTimeout(function () { $('.mcode-arhr .notice').hide(300) }, 3000);
                } else {
                    document.location.reload(true);
                }
            }, 'json'
        );
    }

    /**
     * Деактивировать
     *
     * @param $parent
     * @param $tr
     */
    function deactivateItem($parent, $tr)
    {
        const table = $('.mcode-arhr input[name="table"]').val();

        const data = {
            id: $('input[name="id"]', $parent).val(),
            action: `arhr_${table}_deactivate`,
        };

        $.post(
            ajaxurl, data,
            function (result) {
                if (result['status'] === 'error') {
                    $('.mcode-arhr .notice.error p').html(`Ошибка: ${result['result']}`);
                    $('.mcode-arhr .notice.error').show(300);
                    setTimeout(function () { $('.mcode-arhr .notice').hide(300) }, 3000);
                } else {
                    document.location.reload(true);
                }
            }, 'json'
        );
    }

    function addItemDialog()
    {

        $('.mcode-arhr .notice').hide(300);

        // let firstname = prompt("Введите имя", "");
        //
        // if (firstname) {
        //
        //     let lastname = prompt("Введите фамилию", "");
        //
        //     if (lastname) {
        //
        //         //mcode_person_add
        //
        //         $.post(
        //             ajaxurl, {
        //                 firstname, lastname,
        //                 action: "mcode_person_add"
        //             },
        //             function (result) {
        //
        //                 if (result['status'] === 'error') {
        //
        //                     $('.mcode-arhr .notice.error p').html(`Ошибка: ${result['result']}`);
        //                     $('.mcode-arhr .notice.error').show(300);
        //
        //                     setTimeout(function () {
        //                         $('.mcode-arhr .notice').hide(300);
        //                     }, 3000);
        //
        //                 } else {
        //
        //                     $('.mcode-arhr .notice.updated p').html(`Новая персона добавлена. Ожидайте перезагрузки`);
        //                     $('.mcode-arhr .notice.updated').show(300);
        //
        //                     setTimeout(function () { location.reload(); }, 3000);
        //
        //                 }
        //
        //             }, 'json'
        //         );
        //
        //     } else {
        //         $('.mcode-arhr .notice.error p').html(`Добавление персоны отменено пользователем: не задана фамилия персоны`);
        //         $('.mcode-arhr .notice.error').show(300);
        //
        //         setTimeout(function () {
        //             $('.mcode-arhr .notice').hide(300);
        //         }, 3000);
        //     }
        //
        // } else {
        //
        //     $('.mcode-arhr .notice.error p').html(`Добавление персоны отменено пользователем: не задано имя персоны`);
        //     $('.mcode-arhr .notice.error').show(300);
        //
        //     setTimeout(function () {
        //         $('.mcode-arhr .notice').hide(300);
        //     }, 3000);
        //
        // }
    }

    /**
     * Сбросить изменения в диалоге
     */
    function canselEditor()
    {
        $dialog = $('.item-dialog.visibility');
        if ($dialog.length === 0) {
            return;
        }

        $('.item-field', $dialog).each(function() {
            $(this).val($(this).data('save'));
        });

        const url = $('input.image-url', $dialog).val();
        if (!url || url === '') {
            deleteImage($('.delete-image', $dialog));
        } else {
            const $html = $(`<div class="image-container image" data-id="${$('input[name="id"]', $dialog).val()}"><img src="${url}" class="item-image"/><button class="delete-image page-title-action">Удалить</button></div>`);
            $('.image-container-list', $dialog).html($html);
            $('.delete-image', $html).on('click', function () {
                deleteImage($(this));
            });
        }
    }

    /**
     * Выбрать изображение
     */
    function selectImage($element) {

        const $container = $element.parents('.item-image-container');
        $element = $element.parent();

        let image_frame;
        if (image_frame) image_frame.open();
        image_frame = wp.media({
            title: 'Select Media',
            multiple: false,
            library: {type: 'image'}
        });
        image_frame.on('close', function () {
            const item = image_frame.state().get('selection').first();
            const url = item['attributes']['url'];
            const $html = $(`<div class="image-container image" data-id="${item.id}"><img src="${url}" class="item-image"/><button class="delete-image page-title-action">Удалить</button></div>`);
            $('.image-container-list', $container).html($html);
            $('input.images-text-list', $container).val(item.id);
            $('.delete-image', $html).on('click', function () {
                deleteImage($(this));
            });
        });
        image_frame.open();
    }

    /**
     * Удалить изображение
     * @param $element
     */
    function deleteImage($element) {
        $('input.images-text-list', $element.parents('.item-image-container')).val('');
        $element = $element.parents('.image-container');
        $element.remove();
    }

})(jQuery);