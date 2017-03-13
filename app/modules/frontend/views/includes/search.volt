{{ form('products/search', 'method' : 'get') }}
    {{ text_field('s', 'value' : request.get('s'), 'placeholder' : 'Введите название') }}
    {{ tag_html('button')~image('img/icons/search.png')~tag_html_close('button') }}
{{ endform() }}