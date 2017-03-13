{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Атрибуты</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Добавить атрибут</h3>
                </div>
                <div class="box-body">
                    {{ form('attributes/add') }}
                        <div class="form-group">
                            <label for="attribute">{{ form.getLabel('attribute') }}</label>
                            {{ form.render('attribute') }}
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
                    <h3 class="box-title">Все атрибуты</h3>
                    <div class="btn-group pull-right">
                        {{ link_to('#', '<i class="fa fa-close"></i>', 'class' : 'btn btn-danger products-delete') }}
                    </div>
                    {{ form('attributes/delete', 'class' : 'products-delete-form') }}
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
                        {% for attribute in attributes %}
                            <tr>
                                <td class="check">
                                    <input type="checkbox" id="category-{{ attribute.id }}" data-id="{{ attribute.id }}">
                                    <span><i class="fa fa-check"></i></span>
                                    <label for="category-{{ attribute.id }}"></label>
                                </td>
                                <td>{{ attribute.attribute }}</td>
                                <td>{{ link_to('attributes/edit/'~attribute.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                            </tr>
                        {% endfor %}
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>