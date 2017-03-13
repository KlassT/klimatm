{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Производители</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Добавить производителя</h3>
                </div>
                <div class="box-body">
                    {{ form('brands/add') }}
                        <div class="form-group">
                            <label for="category">{{ form.getLabel('brand') }}</label>
                            {{ form.render('brand') }}
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control">Добавить</button>
                        </div>
                    {{ endForm() }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Все производители</h3>
                    <div class="btn-group pull-right">
                        {{ link_to('#', '<i class="fa fa-close"></i>', 'class' : 'btn btn-danger products-delete') }}
                    </div>
                    {{ form('brands/delete', 'class' : 'products-delete-form') }}
                        {{ hidden_field('items', 'class' : 'checkItems') }}
                        <button type="submit"></button>
                    {{ endform() }}
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="check">
                                <input type="checkbox" id="all" data-id="all">
                                <span><i class="fa fa-check"></i></span>
                                <label for="all"></label>
                            </th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        {% for brand in brands %}
                            <tr>
                                <td class="check">
                                    <input type="checkbox" id="category-{{ brand.id }}" data-id="{{ brand.id }}">
                                    <span><i class="fa fa-check"></i></span>
                                    <label for="category-{{ brand.id }}"></label>
                                </td>
                                <td>{{ brand.brand }}</td>
                                <td>{{ link_to('brands/edit/'~brand.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                            </tr>
                        {% endfor %}
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>