<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{ get_title() }}
    {{ stylesheet_link('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}
    {{ stylesheet_link('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800') }}
    {{ stylesheet_link('https://fonts.googleapis.com/css?family=Roboto+Slab:700') }}
    {{ stylesheet_link('http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}
    {{ stylesheet_link('css/jquery.bxslider.css') }}
    {{ stylesheet_link('css/jquery.fancybox.min.css') }}
    {{ stylesheet_link('css/style.css') }}
    {{ javascript_include('http://code.jquery.com/jquery-latest.min.js') }}
    {{ javascript_include('https://code.jquery.com/ui/1.12.1/jquery-ui.js') }}
    {{ javascript_include('js/jquery.bxslider.min.js') }}
    {{ javascript_include('js/jquery.fancybox.min.js') }}
    {{ javascript_include('js/main.js') }}
</head>
<body>
<header>
    <div class="container">
        <div class="header--block">
            <div class="header--block__logo">
                {{ link_to('/', image('img/logo.png')) }}
            </div>
            <div class="header--block__contacts">
                <div class="phone"><span>8(800)</span> 700-70-55</div>
                <div class="email">Почта@yandex.ru</div>
                <div class="email">с 9:00 до 20:00 без выходных</div>
            </div>
            <div class="header--block__order">
                <p>Не смогли дозвониться?</p>
                <a href="#">Закажите звонок</a>
            </div>
            <div class="header--block__cart">
                {{ partial('includes/cart') }}
            </div>
        </div>
    </div>
</header>
<button class="toggle-menu"><i class="fa fa-bars"></i></button>
<nav>
    <div class="container">
        <div class="nav--block">
            {{ navigation.getMenu() }}
            <div class="search">
                {{ partial('includes/search') }}
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <button class="toggle-categories">Категории <i class="fa fa-bars"></i></button>
</div>
<div class="categories">
    <div class="container">
        {{ navigation.getCategories() }}
    </div>
</div>
<main class="container">
    {{ content() }}
</main>
<footer>
    <div class="container">
        <div class="footer--block">
            <div class="logo">
                {{ link_to('/', image('img/logo2.png')) }}
            </div>
            <div class="footer-info">
                <div class="menu">
                    {{ navigation.getMenu() }}
                </div>
                <div class="contacts">
                    <div class="phone">8(800) 700-70-55</div>
                    <div class="email">Почта@yandex.ru</div>
                </div>
            </div>
            <div class="social">
                <div class="social--block">
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="vk"><i class="fa fa-vk"></i></a>
                    <a href="#" class="odnoklassniki"><i class="fa fa-odnoklassniki"></i></a>
                </div>
                <a href="#">Свяжитесь с нами</a>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p><i class="fa fa-copyright"></i> 2017 Климат Market. Все права защищены</p>
            <p>
                Самая точная информация о товаре, сроке службы и гарантийном сроке нахлодитя на официальном сайте производителя.
                <br />
                Предложения на сайте носят информационный характер и не являются официальной сфертой.
            </p>
        </div>
    </div>
</footer>
</body>
</html>
