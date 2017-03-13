{{ content() }}
<div class="breadcrumbs">
    {{ link_to('/', '<i class="fa fa-home"></i>') }}
    <span><i class="fa fa-angle-right"></i></span>
    <span>{{ page.title }}</span>
</div>
<h1 class="product__title">{{ page.title }}</h1>
<section class="about">
    {{ page.content }}
</section>