{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Добавить товар</h1>
</section>
<section class="content">
    {{ form('products/add', 'enctype' : 'multipart/form-data') }}
        <div class="row">
            <div class="col-sm-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Текст</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">{{ productForm.getLabel('title') }}</label>
                            {{ productForm.render('title') }}
                        </div>
                        <div class="form-group">
                            <label for="description">{{ productForm.getLabel('description') }}</label>
                            {{ productForm.render('description') }}
                        </div>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Дополнительно</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="price">{{ productForm.getLabel('price') }}</label>
                                    <div class="input-group">
                                        {{ productForm.render('price') }}
                                        <div class="input-group-addon">
                                            руб.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sale_price">{{ productForm.getLabel('sale_price') }}</label>
                                    <div class="input-group">
                                        {{ productForm.render('sale_price') }}
                                        <div class="input-group-addon">
                                            руб.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="brand_id">{{ productForm.getLabel('brand_id') }}</label>
                                    {{ productForm.render('brand_id') }}
                                </div>
                                <div class="form-group">
                                    <label for="category_id">{{ productForm.getLabel('category_id') }}</label>
                                    {{ productForm.render('category_id') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Атрибуты</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="attributes">{{ productForm.getLabel('attributes') }}</label>
                            <div class="input-group">
                                {{ productForm.render('attributes') }}
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-info add-attribute"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="attribute-list">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Действия</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-info">Сохранить</button>
                        </div>
                    </div>
                </div>
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Изображения</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ endform() }}
</section>