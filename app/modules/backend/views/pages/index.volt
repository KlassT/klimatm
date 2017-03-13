{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Категории</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        {% for page in pages %}
                            <tr>
                                <td>{{ page.title }}</td>
                                <td>{{ link_to('pages/edit/'~page.id, '<i class="fa fa-edit"></i>', 'class' : 'btn btn-info') }}</td>
                            </tr>
                        {% endfor %}
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>