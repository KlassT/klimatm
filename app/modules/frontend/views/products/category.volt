{{ content() }}

{% if request.has('price_min') %}
    {% set price_min = request.get('price_min') %}
{% else %}
    {% set price_min = priceRange['min'] %}
{% endif %}
{% if request.has('price_max') %}
    {% set price_max = request.get('price_max') %}
{% else %}
    {% set price_max = priceRange['max'] %}
{% endif %}

{% if (category.id == 14) or (category.id == 15) or (category.id == 16) %}
    {% if request.has('power_min') %}
        {% set power_min = request.get('power_min') %}
    {% else %}
        {% set power_min = powerRange['min'] %}
    {% endif %}
    {% if request.has('power_max') %}
        {% set power_max = request.get('power_max') %}
    {% else %}
        {% set power_max = powerRange['max'] %}
    {% endif %}
{% endif %}

<?php
    $brands_ids = explode(',', $this->request->get('brands'));
    $brand_arr = [];
    foreach($brands as $brand) {
        $brand_arr[$brand->id] = false;
    }

    foreach($brands_ids as $brand) {
        $brand_arr[$brand] = true;
    }
?>

<div class="breadcrumbs">
    {{ link_to('/', '<i class="fa fa-home"></i>') }}
    {% if request.has('category') %}
        <span><i class="fa fa-angle-right"></i></span>
        <span>{{ link_to('products/category/'~category.uri, category.category) }}</span>
        <span><i class="fa fa-angle-right"></i></span>
        <span>
            <?php
                echo \App\Models\Categories::findFirst('id = ' . $this->request->get('category'))->category;
            ?>
        </span>
    {% else %}
        <span><i class="fa fa-angle-right"></i></span>
        <span>{{ category.category }}</span>
    {% endif %}
</div>
<div class="page">
    <h1 class="product__title">{{ category.category }}</h1>
    <div class="content">
        <aside>
            <div class="widget widget-categories">
                {% for subcategory in subCategories %}
                    {% if request.get('category') == subcategory.id %}
                        {{ link_to('products/category/'~category.uri~'?category='~subcategory.id, subcategory.category~'<span>('~subcategory.Products.count()~')</span>', 'class' : 'active') }}
                    {% else %}
                        {{ link_to('products/category/'~category.uri~'?category='~subcategory.id, subcategory.category~'<span>('~subcategory.Products.count()~')</span>') }}
                    {% endif %}
                {% endfor %}
            </div>
            <div class="widget-title">Производители</div>
            <div class="widget widget-brands">
                {% for brand in brands %}
                    <div>
                        {% if brand_arr[brand.id] == true %}
                            {{ check_field('brand', 'value' : brand.id, 'id' : 'brand-'~brand.id, 'checked' : true) }}
                        {% else %}
                            {{ check_field('brand', 'value' : brand.id, 'id' : 'brand-'~brand.id) }}
                        {% endif %}
                        <label for="brand-{{ brand.id }}">{{ brand.brand }}</label>
                    </div>
                {% endfor %}
            </div>
            <div class="widget-title">Цена</div>
            <div class="widget widget-price">
                <div class="slider-range1"></div>
                <script>
                    $( ".slider-range1" ).slider({
                        range: true,
                        min: {{ priceRange['min'] }},
                        max: {{ priceRange['max'] }},
                        values: [ {{ price_min }}, {{ price_max }} ],
                        slide: function( event, ui ) {
                            $( ".price-text1" ).text("Цена: " + ui.values[ 0 ] + "{{ " "|price }} - " + ui.values[ 1 ] + "{{ " "|price }}" );
                            $('input[name=price_min]').val(ui.values[0]);
                            $('input[name=price_max]').val(ui.values[1]);
                        }
                    });
                </script>
                {% if request.has('price_min') %}
                    <div class="price-text price-text1">Цена: {{ price_min|price }} - {{ price_max|price }}</div>
                {% else %}
                    <div class="price-text price-text1">Цена: {{ priceRange['min']|price }} - {{ priceRange['max']|price }}</div>
                {% endif %}
            </div>
            {% if (category.id == 14) or (category.id == 15) or (category.id == 16) %}
                <div class="widget-title">Мощность</div>
                <div class="widget widget-price">
                    <div class="slider-range2"></div>
                    <script>
                        $( ".slider-range2" ).slider({
                            range: true,
                            step: 0.5,
                            min: {{ powerRange['min'] }},
                            max: {{ powerRange['max'] }},
                            values: [ {{ power_min }}, {{ power_max }} ],
                            slide: function( event, ui ) {
                                $( ".price-text2" ).text("Мощность: " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                                $('input[name=power_min]').val(ui.values[0]);
                                $('input[name=power_max]').val(ui.values[1]);
                            }
                        });
                    </script>
                    {% if request.has('power_min') %}
                        <div class="price-text price-text2">Мощность: {{ power_min }} - {{ power_max }}</div>
                    {% else %}
                        <div class="price-text price-text2">Мощность: {{ powerRange['min'] }} - {{ powerRange['max'] }}</div>
                    {% endif %}
                </div>
            {% endif %}
            {{ form('products/category/'~category.uri, 'method' : 'get') }}
                {{ hidden_field('price_min', 'value' : price_min) }}
                {{ hidden_field('price_max', 'value' : price_max) }}
                {% if (category.id == 14) or (category.id == 15) or (category.id == 16) %}
                    {{ hidden_field('power_min', 'value' : power_min) }}
                    {{ hidden_field('power_max', 'value' : power_max) }}
                {% endif %}
                {{ hidden_field('category', 'value' : request.get('category')) }}
                {{ hidden_field('brands', 'value' : request.get('brands')) }}
                <button type="submit" class="filter-apply">Применить</button>
            {{ endform() }}
            {{ form('products/category/'~category.uri, 'method' : 'get') }}
                {{ hidden_field('category', 'value' : request.get('category')) }}
                <button type="submit" class="filter-reset">Очистить</button>
            {{ endform() }}
        </aside>
        <section class="products">
            <div class="section--body">
                {% if products.items %}
                {% for product in products.items %}
                    <div class="product--item">
                        <div class="product--image">
                            {{ link_to('product/'~product.uri, image('files/products/'~product.image, 'width' : 180)) }}
                        </div>
                        <div class="product--title">
                            {{ link_to('product/'~product.uri, product.title) }}
                        </div>
                        <div class="product--buttons">
                            <div class="product--price">
                                {% if product.sale_price != null %}
                                    {{ product.sale_price|price }}
                                {% else %}
                                    {{ product.price|price }}
                                {% endif %}
                            </div>
                            {{ form('products/add/'~product.id) }}
                                <div class="product__add-to-cart">
                                    {{ hidden_field('count', 'value' : 1, 'class' : 'product__count') }}
                                    <button type="submit" class="btn btn-primary btn-lg btn-block product--buy">Купить</button>
                                </div>
                            {{ endform() }}
                        </div>
                    </div>
                {% endfor %}
            </div>
            <div class="section--footer">
                {{ form('products/category/'~category.uri, 'method' : 'get', 'class' : 'pagination-form') }}
                    {{ hidden_field('price_min', 'value' : price_min) }}
                    {{ hidden_field('price_max', 'value' : price_max) }}
                    {% if (category.id == 14) or (category.id == 15) or (category.id == 16) %}
                        {{ hidden_field('power_min', 'value' : power_min) }}
                        {{ hidden_field('power_max', 'value' : power_max) }}
                    {% endif %}
                    {{ hidden_field('category', 'value' : request.get('category')) }}
                    {{ hidden_field('brands', 'value' : request.get('brands')) }}
                    {{ hidden_field('page', 'value' : request.get('page')) }}
                {{ endform() }}
                <div class="pagination">
                    {% if products.first != products.current %}
                        {{ link_to('#', '<i class="fa fa-angle-double-left"></i>', 'data-page' : products.first) }}
                    {% endif %}
                    {% if products.before != products.current %}
                        {{ link_to('#', '<i class="fa fa-angle-left"></i>', 'data-page' : products.before) }}
                    {% endif %}
                    {% if products.next != products.current %}
                        {{ link_to('#', '<i class="fa fa-angle-right"></i>', 'data-page' : products.next) }}
                    {% endif %}
                    {% if products.last != products.current %}
                        {{ link_to('#', '<i class="fa fa-angle-double-right"></i>', 'data-page' : products.last) }}
                    {% endif %}
                </div>
            {% else %}
                Товары не найдены
            {% endif %}
            </div>
        </section>
    </div>
</div>