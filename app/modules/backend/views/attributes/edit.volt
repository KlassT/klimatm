{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Атрибуты</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Редактировать атрибут</h3>
                </div>
                <div class="box-body">
                    {{ form('attributes/edit/'~attribute.id) }}
                        <div class="form-group">
                            <label for="attribute">{{ form.getLabel('attribute') }}</label>
                            {{ form.render('attribute') }}
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