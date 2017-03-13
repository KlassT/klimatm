{{ content() }}
{{ flashSession.output() }}
<div class="breadcrumbs">
    {{  link_to('/', '<i class="fa fa-home"></i>') }}
    <span><i class="fa fa-angle-right"></i></span>
    {% if product.Category.parent == null %}
        <span>{{ link_to('products/category/'~product.Category.uri, product.Category.category) }}</span>
    {% else %}
        <span>{{ link_to('products/category/'~product.Category.MainCategory.uri, product.Category.MainCategory.category) }}</span>
        <span><i class="fa fa-angle-right"></i></span>
        <span>{{ link_to('products/category/'~product.Category.MainCategory.uri~'?category='~product.Category.id, product.Category.category) }}</span>
    {% endif %}
    <span><i class="fa fa-angle-right"></i></span>
    <span>{{ product.title }}</span>
</div>
<div class="product--block">
    <div class="product__images">
        <div class="product__images_big">
            {{ link_to('files/products/'~product.Image.image, image('files/products/'~product.Image.image, 'width' : 300)) }}
        </div>
    </div>
    <div class="product__info">
        <h1 class="product__title">{{ product.title }}</h1>
        <div class="product__price">
            Цена:
            {% if product.sale_price %}
                <span>{{ product.sale_price|price }}</span>
            {% else %}
                <span>{{ product.price|price }}</span>
            {% endif %}
        </div>
        {{ form('products/add/'~product.id) }}
            <div class="product__add-to-cart">
                {{ text_field('count', 'value' : 1, 'class' : 'product__count') }}
                <button type="submit" id="button-cart" data-loading-text="" class="btn btn-primary btn-lg btn-block">Купить</button>
            </div>
        {{ endform() }}
        <div class="product__meta">
            <div class="product__categories">Производитель: {{ product.Brand.brand }}</div>
            <div class="product__categories">
                Категория:
                {% if product.Category.parent == null %}
                    {{ link_to('products/category/'~product.Category.uri, product.Category.category) }}
                {% else %}
                    {{ link_to('products/category/'~product.Category.MainCategory.uri~'?category='~product.Category.id, product.Category.category) }}
                {% endif %}
            </div>
        </div>
    </div>
</div>
<div class="product__description">
    <h2 class="product__title">Описание товара</h2>
    <div class="product__description_text">{{ product.description }}</div>
</div>
<div class="product__attributes">
    <h2 class="product__title">Характеристики товара</h2>
    <table cellpadding="0" cellspacing="0">
        {% for attribute in product.Attributes %}
            <tr>
                <td>{{ attribute.Attribute.attribute }}</td>
                <td>{{ attribute.value }}</td>
            </tr>
        {% endfor %}
    </table>
</div>
{% if lastViews.count() %}
    <section class="products">
        <div class="section--header">
            <h2 class="section--title">Последние просмотры</h2>
        </div>
        <div class="section--body">
            {% for lastView in lastViews %}
                <div class="product--item">
                    <div class="product--image">
                        {{ link_to('product/'~lastView.Product.uri, image('files/products/'~lastView.Product.Image.image, 'width' : 180)) }}
                    </div>
                    <div class="product--title">
                        {{ link_to('product/'~lastView.Product.uri, lastView.Product.title) }}
                    </div>
                    <div class="product--buttons">
                        <div class="product--price">
                            {% if lastView.Product.sale_price != null %}
                                {{ lastView.Product.sale_price|price }}
                            {% else %}
                                {{ lastView.Product.price|price }}
                            {% endif %}
                        </div>
                        {{ form('products/add/'~lastView.Product.id) }}
                        <div class="product__add-to-cart">
                            {{ hidden_field('count', 'value' : 1, 'class' : 'product__count') }}
                            <button type="submit" class="btn btn-primary btn-lg btn-block product--buy">Купить</button>
                        </div>
                        {{ endform() }}
                    </div>
                </div>
            {% endfor %}
        </div>
    </section>
{% endif %}