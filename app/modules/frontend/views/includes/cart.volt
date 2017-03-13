<div id="cart" class="cart">
    <div class="cart--icon">
        {{ image('img/icons/cart.png') }}
    </div>
    <div class="cart--caption">
        <a href="{{ url('cart') }}">Корзина <span>{{ cart.total()|price }}</span></a>
    </div>
</div>