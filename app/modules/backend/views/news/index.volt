{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Новости</h1>
    <div class="btn-group pull-right">
        {{ link_to('news/add', '<i class="fa fa-plus"></i>', 'class' : 'btn btn-info') }}
        {{ link_to('#', '<i class="fa fa-close"></i>', 'class' : 'btn btn-danger products-delete') }}
    </div>
    {{ form('news/delete', 'class' : 'products-delete-form') }}
        {{ hidden_field('items', 'class' : 'checkItems') }}
        <button type="submit"></button>
    {{ endform() }}
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Все новости</h3>
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
                        {% for post in news.items %}
                            <tr>
                                <td class="check">
                                    <input type="checkbox" id="post-{{ post.id }}" data-id="{{ post.id }}">
                                    <span><i class="fa fa-check"></i></span>
                                    <label for="post-{{ post.id }}"></label>
                                </td>
                                <td>{{ post.title }}</td>
                                <td>{{ link_to('news/edit/'~post.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                            </tr>
                        {% endfor %}
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-lg no-margin pull-right">
                        {% if news.current !=  news.first %}
                            <li>{{ link_to('news/?page='~news.before, '«') }}</li>
                        {% endif %}
                        {% if news.current !=  news.last %}
                            <li>{{ link_to('news/?page='~news.next, '»') }}
                        {% endif %}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>