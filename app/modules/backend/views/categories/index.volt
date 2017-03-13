{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Категории</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Добавить категорию</h3>
                </div>
                <div class="box-body">
                    {{ form('categories/add', 'enctype' : 'multipart/form-data') }}
                        <div class="form-group">
                            <label for="category">{{ form.getLabel('category') }}</label>
                            {{ form.render('category') }}
                        </div>
                        <div class="form-group">
                            <label for="parent">{{ form.getLabel('parent') }}</label>
                            {{ form.render('parent') }}
                        </div>
                        <div class="form-group">
                            <label for="image">{{ form.getLabel('image') }}</label>
                            {{ form.render('image') }}
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-info form-control">Добавить</button>
                        </div>
                    {{ endForm() }}
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Все категории</h3>
                    <div class="btn-group pull-right">
                        {{ link_to('#', '<i class="fa fa-close"></i>', 'class' : 'btn btn-danger products-delete') }}
                    </div>
                    {{ form('categories/delete', 'class' : 'products-delete-form') }}
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
                        {% for category in categories %}
                            <tr>
                                <td class="check">
                                    <input type="checkbox" id="category-{{ category.id }}" data-id="{{ category.id }}">
                                    <span><i class="fa fa-check"></i></span>
                                    <label for="category-{{ category.id }}"></label>
                                </td>
                                <td>{{ category.category }}</td>
                                <td>{{ link_to('categories/edit/'~category.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                            </tr>
                            {% if category.Subcategories.count() %}
                                <tr class="subcategory-title"><td colspan="3">Подкатегории</td></tr>
                            {% endif %}
                            {% for subcategory in category.Subcategories %}
                                <tr style="padding-left: 20px;">
                                    <td class="check">
                                        <input type="checkbox" id="category-{{ subcategory.id }}" data-id="{{ subcategory.id }}">
                                        <span><i class="fa fa-check"></i></span>
                                        <label for="category-{{ subcategory.id }}"></label>
                                    </td>
                                    <td>{{ subcategory.category }}</td>
                                    <td>{{ link_to('categories/edit/'~subcategory.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                                </tr>
                            {% endfor %}
                        {% endfor %}
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>