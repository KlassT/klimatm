$(function () {
    $('.toggle-categories').click(function () {
        $('.categories').toggleClass('showed');
    });

    $('.toggle-menu').click(function () {
        $('nav').toggleClass('showed');
        $('body').toggleClass('no-scroll');
    });

    $('.widget-brands input').on('change', function () {
        var brands = [];
        $('.widget-brands input').each(function () {
            if($(this).prop('checked')) {
                brands.push($(this).val());
            }
        });
        $('input[name=brands]').val(brands.join(','))
    });

    $('.pagination a').on('click', function () {
        var page = $(this).data('page');
        $('input[name=page]').val(page);
        $('.pagination-form').submit();
        return false;
    });

    $('[data-type="tab"]').on('click', function () {
        $('[data-type="tab"]').removeClass('active');
        $(this).addClass('active');
        $('[data-type="tab-block"]').hide();
        $('[data-type="tab-block"][data-section="' + $(this).data('section') + '"]').show();
        return false;
    });

    $('.product__images_big a').fancybox({
        padding: 0
    });

    setTimeout(function () {
        $('.alert').hide();
    }, 5000);
});