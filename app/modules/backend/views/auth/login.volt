<div class="login-box">
    <div class="login-logo">
        <b>Fir</b>ma
    </div>
    <div class="messages">{{ content() }}</div>
    <div class="login-box-body">
        <p class="login-box-msg">Вход в административную панель</p>
        {{ form('auth/login') }}
            <div class="form-group has-feedback">
                {{ loginForm.render('login') }}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {{ loginForm.render('password') }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
                </div>
            </div>
        {{ endform() }}
    </div>
</div>