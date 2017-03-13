{{ content() }}
<div class="breadcrumbs">
    {{ link_to('/', '<i class="fa fa-home"></i>') }}
    <span><i class="fa fa-angle-right"></i></span>
    {{ post.title }}
</div>
<div class="product__description">
    <h2 class="product__title">{{ post.title }}</h2>
    <div class="product__description_text">{{ post.description }}</div>
</div>