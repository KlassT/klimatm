{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Товары</h1>
    <div class="btn-group pull-right">
        {{ link_to('products/add', '<i class="fa fa-plus"></i>', 'class' : 'btn btn-info') }}
        {{ link_to('#', '<i class="fa fa-close"></i>', 'class' : 'btn btn-danger products-delete') }}
    </div>
    {{ form('products/delete', 'class' : 'products-delete-form') }}
        {{ hidden_field('items', 'class' : 'checkItems') }}
        <button type="submit"></button>
    {{ endform() }}
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Все товары</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="s" class="form-control pull-right" placeholder="Поиск">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
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
                            <th>Цена</th>
                            <th>Действия</th>
                        </tr>
                        {% for product in products.items %}
                            <tr>
                                <td class="check">
                                    <input type="checkbox" id="product-{{ product.id }}" data-id="{{ product.id }}">
                                    <span><i class="fa fa-check"></i></span>
                                    <label for="product-{{ product.id }}"></label>
                                </td>
                                <td>{{ product.title }}</td>
                                <td>{{ product.price|price }}</td>
                                <td>{{ link_to('products/edit/'~product.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                            </tr>
                        {% endfor %}
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-lg no-margin pull-right">
                        {% if products.current !=  products.first %}
                            <li>{{ link_to('products/?page='~products.before, '«') }}</li>
                        {% endif %}
                        {% if products.current !=  products.last %}
                            <li>{{ link_to('products/?page='~products.next, '»') }}
                        {% endif %}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>