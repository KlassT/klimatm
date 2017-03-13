{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Производители</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Редактировать производителя</h3>
                </div>
                <div class="box-body">
                    {{ form('brands/edit/'~brand.id) }}
                        <div class="form-group">
                            <label for="brand">{{ form.getLabel('brand') }}</label>
                            {{ form.render('brand') }}
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control">Сохранить</button>
                        </div>
                    {{ endForm() }}
                </div>
            </div>
        </div>
    </div>
</section>