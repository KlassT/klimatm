{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Категории</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Редактировать категорию</h3>
                </div>
                <div class="box-body">
                    {{ form('categories/edit/'~category.id, 'enctype' : 'multipart/form-data') }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">{{ form.getLabel('category') }}</label>
                                {{ form.render('category') }}
                            </div>
                            <div class="form-group">
                                <label for="parent">{{ form.getLabel('parent') }}</label>
                                {{ form.render('parent') }}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">{{ form.getLabel('image') }}</label>
                                {{ form.render('image') }}
                            </div>
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-info form-control">Сохранить</button>
                            </div>
                        </div>
                    </div>
                    {{ endForm() }}
                </div>
            </div>
        </div>
    </div>
</section>