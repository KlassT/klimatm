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