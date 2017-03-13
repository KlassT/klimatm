{{ content() }}
<!--
{% if slides.count() %}
    <div class="slider">
        {% for slide in slides %}
            <div class="item">
                {% if slide.link_type == 'static' %}
                    {{ image('files/slides/'~slide.image) }}
                {% else %}
                    {{ link_to(slide.link, image('files/slides/'~slide.image)) }}
                {% endif %}
            </div>
        {% endfor %}
    </div>
    <script>
        $('.slider').bxSlider();
    </script>
{% endif %}
-->
<div class="slider">
    <div class="item">
        {{ image('img/asdfasdg.jpg') }}
    </div>
    <div class="item">
        {{ image('img/asdfasdg.jpg') }}
    </div>
</div>
<script>
    $('.slider').bxSlider();
</script>

<div class="services">
    <a href="{{ url('pages/montazh-konditsionierov') }}" class="services--item">
        <div class="icon">{{ image('img/icons/installation.png') }}</div>
        <div class="caption">Монтаж оборудования</div>
    </a>
    <a href="{{ url('pages/dostavka-tovarov') }}" class="services--item">
        <div class="icon">{{ image('img/icons/delivery.png') }}</div>
        <div class="caption">Доставка заказов</div>
    </a>
    <a href="{{ url('pages/obsluzhivaniie-konditsionierov') }}" class="services--item">
        <div class="icon">{{ image('img/icons/service.png') }}</div>
        <div class="caption">Сервисное обслуживание</div>
    </a>
    <a href="{{ url('#') }}" class="services--item">
        <div class="icon">{{ image('img/icons/book.png') }}</div>
        <div class="caption">Объекты под ключ</div>
    </a>
</div>

<section class="products">
    <div class="section--header">
        <h2 class="section--title"><a href="#" data-type="tab" data-section="new" class="active">Новинки</a></h2>
        <h2 class="section--title"><a href="#" data-type="tab" data-section="sales">Распродажа</a></h2>
        <h2 class="section--title"><a href="#" data-type="tab" data-section="hits">Хиты продаж</a></h2>
    </div>
    <div class="section--body" data-type="tab-block" data-section="new">
        {% set products = newProducts %}
        {% for product in products %}
            {{ partial('includes/product') }}
        {% endfor %}
    </div>
    <div class="section--body" data-type="tab-block" data-section="sales" style="display: none;">
        {% set products = saleProducts %}
        {% for product in products %}
            {{ partial('includes/product') }}
        {% endfor %}
    </div>
    <div class="section--body" data-type="tab-block" data-section="hits" style="display: none;">

    </div>
</section>

<section class="row">
    <div class="section--block">
        <div class="section--header">
            <h2 class="section--title">Новости</h2>
            <div class="section--more">
                {{ link_to('news', 'Все новости') }}
            </div>
        </div>
        <section class="news">
            {% for post in news %}
                <div class="news--item">
                    <div class="news--image">{{ image('files/news/'~post.image, 'width' : 250) }}</div>
                    <div>
                        <div class="news--date">{{ post.created_at|diff }}</div>
                        <div class="news--title">{{ link_to('articles/news/'~post.uri, post.title) }}</div>
                        <div class="news--description">{{ post.description|substr }}</div>
                    </div>
                </div>
            {% endfor %}
        </section>
    </div>
    <div class="section--block">
        <div class="section--header">
            <h2 class="section--title">Акции</h2>
            <div class="section--more">
                {{ link_to('sales', 'Все акции') }}
            </div>
        </div>
        <section class="news">
            {% for post in sales %}
                <div class="news--item">
                    <div class="news--image">{{ image('files/news/'~post.image, 'width' : 250) }}</div>
                    <div>
                        <div class="news--date">{{ post.created_at|diff }}</div>
                        <div class="news--title">{{ link_to('articles/news/'~post.uri, post.title) }}</div>
                        <div class="news--description">{{ post.description|substr }}</div>
                    </div>
                </div>
            {% endfor %}
        </section>
    </div>
</section>

<section class="about">
    <h2 style="font-family: 'Roboto Slab', serif;">Кондиционеры, обогреватели, теплый пол и другая климатическая техника в "Климат.Market"</h2>
    <p>Компания «Климат.Market» специализируется на продаже, монтаже и сервисном обслуживании климатической техники. Отделения компании расположены в Санкт-Петербурге, так же осуществляется поставка оборудования во все регионы РФ. Ассортимент каталога насчитывает более 16 000 позиций, от бытовой техники до тяжелого промышленного оборудования. Для удобства клиентов сайт компании выполнен в формате удобного интернет-магазина климатической техники, в котором можно легко подобрать и заказать необходимое Вам оборудование. Мы предлагаем своим клиентам только лучшую климатическую технику российских и зарубежных производителей. Наш интернет-магазин практикует индивидуальный подход к каждому клиенту и к его потребностям, а цены вас несомненно порадуют.</p>
    <h3>Продажа кондиционеров. Монтаж и сервисное обслуживание.</h3>
    <p>Кондиционер уже давно стал привычным и необходимым прибором для создания комфорта в квартире, офисе и производственном здании. Кондиционер в помещении не только спасает от летней жары, им можно согреть квартиру в холодную погоду, очистить от пыли и уменьшить уровень влажности. Компания «Климат.Market» специализируется на кондиционерах всех типов от настенных сплит-систем до VRF систем и установок центрального кондиционирования. Цена кондиционера все чаще играет решающую роль в выборе поставщика. Наша компания сотрудничает с производителями оборудования на прямую, поэтому у нас вы можете купить кондиционер по очень привлекательной стоимости. При этом мы обеспечиваем высокое качество обслуживания клиентов и предоставляем полный комплекс услуг по монтажу и сервисному обслуживанию кондиционеров.</p>
    <h3>Выбирая нас, вы можете рассчитывать на:</h3>
    <ul>
        <li>Обширный, и постоянно пополняющийся прайс товаров, в котором представлены самые популярные марки климатической техники.</li>
        <li>Гарантия от производителя и сервисное обслуживание приобретенных вами товаров нашими специалистами.</li>
        <li>Оперативную доставку и широкие возможности для оплаты товаров.</li>
        <li>Услуги по монтажу и установке вашей новой техники.</li>
        <li>Отзывы других клиентов, которые помогут быстрее определиться с выбором.</li>
        <li>Детальное описание каждой позиции, содержащее все модели и цены, а так же другую важную информацию.</li>
        <li>Выезд к вам специалиста для анализа объекта и подбора оборудования бесплатное (в черте города).</li>
    </ul>
    <p>Нужна консультация специалиста? Хотите заказать оборудование или монтаж? Позвоните нам по телефону 8-800-700-70-55. Мы всегда рады Вам помочь!</p>
</section>

<section class="brands">
    {{ image('img/brands/daikin.png') }}
    {{ image('img/brands/electrolux.png') }}
    {{ image('img/brands/lessar.png') }}
    {{ image('img/brands/toshiba.png') }}
    {{ image('img/brands/fujitsu.png') }}
    {{ image('img/brands/airwell.png') }}
</section>