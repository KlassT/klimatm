{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Панель управления</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ countProducts }}</h3>
                    <p>Продуктов</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ countUsers }}</h3>
                    <p>Пользователей</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ countOrders }}</h3>
                    <p>Заказов</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pricetags"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ countInCart }}</h3>
                    <p>В корзине</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
    </div>
</section>