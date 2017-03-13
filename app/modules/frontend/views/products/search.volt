{{ content() }}

<div class="breadcrumbs">
    {{  link_to('/', '<i class="fa fa-home"></i>') }}
    <span><i class="fa fa-angle-right"></i></span>
    <span>{{ request.get('s') }}</span>
</div>
<div class="page">
    <h1 class="product__title">Поиск по запросу: {{ request.get('s') }}</h1>
    <div class="content">
        <section class="products">
            <div class="section--body">
                {% for product in products %}
                    <div class="product--item">
                        <div class="product--image">
                            {{ link_to('product/'~product.uri, image('files/products/'~product.Image.image, 'width' : 180)) }}
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
                {% elsefor %}
                    <p>Ничего не найдено</p>
                {% endfor %}
            </div>
        </section>
    </div>
</div>