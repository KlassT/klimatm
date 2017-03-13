{{ content() }}
<section class="content-header clearfix">
    <h1 class="pull-left">Добавить новость</h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-body">
            {{ form('news/add', 'enctype' : 'multipart/form-data') }}
                {% for element in form %}
                    <div class="form-group">
                        <label for="{{ element.getName() }}">{{ element.getLabel() }}</label>
                        {{ element }}
                    </div>
                {% endfor %}
                <div class="form-group">
                    <label for="image">Изображение</label>
                    <input type="file" name="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info form-control">Добавить</button>
                </div>
            {{ endform() }}
        </div>
    </div>
</section>