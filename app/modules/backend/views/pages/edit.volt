{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Страницы</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Редактировать страницу</h3>
                </div>
                <div class="box-body">
                    {{ form('pages/edit/'~page.id) }}
                        <div class="form-group">
                            <label for="title">{{ form.getLabel('title') }}</label>
                            {{ form.render('title') }}
                        </div>
                        <div class="form-group">
                            <label for="content">{{ form.getLabel('content') }}</label>
                            {{ form.render('content') }}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info form-control">Сохранить</button>
                        </div>
                    {{ endForm() }}
                </div>
            </div>
        </div>
    </div>
</section>