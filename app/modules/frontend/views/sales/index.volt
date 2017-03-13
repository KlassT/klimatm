{{ content() }}

<div class="breadcrumbs">
    {{  link_to('/', '<i class="fa fa-home"></i>') }}
    <span><i class="fa fa-angle-right"></i></span>
    <span>Акции</span>
</div>
<div class="page">
    <h1 class="product__title">Акции</h1>
    <div class="content">
        <section class="products">
            <div class="section--body">
                {% for post in posts.items %}
                    <div class="product--item">
                        <div class="product--image">
                            {{ image('files/news/'~post.image, 'width' : 180) }}
                        </div>
                        <div class="product--title">
                            {{ link_to('articles/news/'~post.uri, post.title) }}
                        </div>
                        <div class="product--description">{{ post.description|substr }}</div>
                    </div>
                {% endfor %}
            </div>
        </section>
    </div>
</div>