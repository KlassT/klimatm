<?php

namespace App;

use App\Models\Categories;
use App\Models\Users;
use Phalcon\Mvc\User\Component;

class Navigation extends Component
{

    private $_menu = [
        'index' => 'Продукты',
        'pages/uslugi' => 'Услуги',
        'pages/information' => 'Информация',
        'pages/about' => 'О компании',
        'pages/contacts' => 'Контакты',

    ];

    private $_adminMenu = [
        'index' => [
            'caption'   => 'Панель управления',
            'icon'      => 'dashboard',
            'childrens' => false,
            'labels'    => false
        ],
        'products' => [
            'caption'   => 'Продукты',
            'icon'      => 'shopping-basket',
            'childrens' => [
                'index' => 'Все товары',
                'add'   => 'Добавить'
            ],
            'labels'    => false
        ],
        'categories' => [
            'caption'   => 'Категории',
            'icon'      => 'list',
            'childrens' => false,
            'labels'    => false
        ],
        'brands' => [
            'caption'   => 'Производители',
            'icon'      => 'user',
            'childrens' => false,
            'labels'    => false
        ],
        'attributes' => [
            'caption'   => 'Атрибуты',
            'icon'      => 'anchor',
            'childrens' => false,
            'labels'    => false
        ],
        'pages' => [
            'caption'   => 'Страницы',
            'icon'      => 'file',
            'childrens' => false,
            'labels'    => []
        ],
        'users' => [
            'caption'   => 'Пользователи',
            'icon'      => 'users',
            'childrens' => false,
            'labels'    => []
        ],
        'news' => [
            'caption'   => 'Новости',
            'icon'      => 'file-o',
            'childrens' => [
                'index' => 'Все новости',
                'add'   => 'Добавить'
            ],
            'labels'    => false
        ],
        'sales' => [
            'caption'   => 'Акции',
            'icon'      => 'file-o',
            'childrens' => [
                'index' => 'Все акции',
                'add'   => 'Добавить'
            ],
            'labels'    => false
        ],
    ];

    public function __construct()
    {
        $this->_adminMenu['users']['labels']['green'] = Users::countNew();
    }

    public function getMenu()
    {
        echo $this->tag->tagHtml('ul');
            foreach ($this->_menu as $controller => $caption) {
                $parameters = [];
                if($this->dispatcher->getControllerName() == $controller) {
                    $parameters['class'] = 'active';
                }
                echo $this->tag->tagHtml('li', $parameters);
                echo $this->tag->linkTo('/' . $controller, $caption, $parameters);
                echo $this->tag->tagHtmlClose('li');
            }
        echo $this->tag->tagHtmlClose('ul');
    }

    public function getCategories()
    {
        echo $this->tag->tagHtml('ul', ['class' => 'categories--block']);
        $categories = Categories::find([
            'parent IS NULL',
            'order' => 'category'
        ]);
        foreach($categories as $category) {
            echo $this->tag->tagHtml('li');
            $link = "";
            $link .= $this->tag->tagHtml('span', ['class' => 'category--image']);
            $link .= $this->tag->image(['files/categories/' . $category->image, 'width' => 105]);
            $link .= $this->tag->tagHtmlClose('span');
            $link .= $this->tag->tagHtml('span', ['class' => 'category--caption']);
            $link .= $category->category;
            $link .= $this->tag->tagHtmlClose('span');

            echo $this->tag->linkTo('products/category/' . $category->uri, $link);
            echo $this->tag->tagHtmlClose('li');
        }
        echo $this->tag->tagHtmlClose('ul');
    }

    public function getAdminMenu() {
        echo $this->tag->tagHtml('ul', ['class' => 'sidebar-menu']);
            echo $this->tag->tagHtml('li', ['class' => 'header']);
                echo 'ГЛАВНОЕ МЕНЮ';
            echo $this->tag->tagHtmlClose('li');
            foreach ($this->_adminMenu as $controller => $item) {
                $liClasses = [];
                if($item['childrens']) {
                    $liClasses[] = 'treeview';
                }
                if($this->dispatcher->getControllerName() == $controller) {
                    $liClasses[] = 'active';
                }
                echo $this->tag->tagHtml('li', ['class' => join(' ', $liClasses)]);
                    $link = '<i class="fa fa-' . $item['icon']. '"></i><span>' . $item['caption'] . '</span>';
                    if($item['labels']) {
                        $link .= '<span class="pull-right-container">';
                            foreach ($item['labels'] as $color => $label) {
                                $link .= '<small class="label pull-right bg-' . $color . '">' . $label . '</small>';
                            }
                        $link .= '</span>';
                    }
                    if($item['childrens']) $link .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
                    echo $this->tag->linkTo($controller, $link);
                    if($item['childrens']) {
                        echo $this->tag->tagHtml('ul', ['class' => 'treeview-menu']);
                            foreach($item['childrens'] as $action => $subitem) {
                                $active = '';
                                if($this->dispatcher->getControllerName() == $controller && $this->dispatcher->getActionName() == $action) {
                                    $active = 'active';
                                }
                                echo $this->tag->tagHtml('li', ['class' => $active]);
                                    echo $this->tag->linkTo([$controller . '/' . $action, '<i class="fa fa-circle-o"></i>' . $subitem]);
                                echo $this->tag->tagHtmlClose('li');
                            }
                        echo $this->tag->tagHtmlClose('ul');
                    }
                echo $this->tag->tagHtmlClose('li');
            }
        echo $this->tag->tagHtmlClose('ul');
    }

}