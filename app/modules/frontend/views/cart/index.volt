{{ content() }}
{{ flashSession.output() }}
<div class="breadcrumbs">
    <div class="breadcrumbs">
        {{ link_to('/', '<i class="fa fa-home"></i>') }}
        <span><i class="fa fa-angle-right"></i></span>
        <span>Корзина</span>
    </div>
</div>
<div class="page">
    <h1 class="product__title">Корзина</h1>
    <div class="cart">
        <table>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Итого</th>
                <th>Действия</th>
            </tr>
            <?php $total = 0; ?>
            {% for product in cart %}
                <tr>
                    <td>{{ image('files/products/'~product.Product.Image.image, 'width' : 100) }}</td>
                    <td>{{ product.Product.title }}</td>
                    {% if product.Product.sale_price %}
                        {% set price = product.Product.sale_price %}
                    {% else %}
                        {% set price = product.Product.price %}
                    {% endif %}
                    <td>{{ price|price }}</td>
                    <td>{{ product.count }}</td>
                    <td>{{ product.count * price }}</td>
                    <td>{{ link_to('cart/delete/'~product.id, '<i class="fa fa-close"></i>', 'class' : 'delete') }}</td>
                    <?php $total += $product->count * $price; ?>
                </tr>
            {% endfor %}
        </table>
        <div class="cart-footer">
            <div class="total"><span>Всего к оплате:</span> {{ total|price }}</div>
            {{ link_to('cart', 'Оплатить') }}
        </div>
    </div>
</div>