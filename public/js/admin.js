$(function () {

    $('.check input').on('change', function () {
        if($(this).data('id') == 'all') {
            var propCheck = $(this).prop('checked');
            $('.check input').each(function () {
                if($(this).prop('checked') != propCheck) {
                    $(this).siblings('label').trigger('click');
                }
            });
        }

        var itemsChecked = [];
        $('.check input').each(function () {
            if(($(this).prop('checked')) && ($(this).data('id') != 'all')) {
                itemsChecked.push($(this).data('id'));
            }
        });
        $('.checkItems').val(itemsChecked.join(','))
    });

    $('.products-delete').on('click', function () {
        $('.products-delete-form').submit();
        return false;
    });

    $('.select2').select2({
        placeholder : 'Выберите'
    });

    $('.add-attribute').on('click', function () {
        $('.attribute-list').append(
            '<div class="form-group" data-attribute="' + $('#attributes').val() + '">' +
                '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                        $('#attributes option:checked').text() +
                    '</div>' +
                    '<input type="text" name="attribute[' + $('#attributes').val() + ']" value="" class="form-control" />' +
                    '<div class="input-group-btn">' +
                        '<button type="button" class="btn btn-danger delete-attribute" data-attribute="' + $('#attributes').val() + '"><i class="fa fa-close"></i></button>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    });

    $('.attribute-list').on('click', '.delete-attribute', function () {
        var attr = $(this).data('attribute');
        console.log(attr);
        $('.attribute-list .form-group[data-attribute=' + attr + ']').remove();
    });

});