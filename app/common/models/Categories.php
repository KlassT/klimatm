<?php
namespace App\Models;

use Phalcon\Mvc\Model\Relation;

class Categories extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $category;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $parent;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $image;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $uri;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");

        $this->hasMany(
            'id',
            'App\Models\Categories',
            'parent',
            [
                'alias' => 'Subcategories',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );

        $this->hasMany(
            'id',
            'App\Models\Products',
            'category_id',
            [
                'alias' => 'Products'
            ]
        );

        $this->belongsTo(
            'parent',
            'App\Models\Categories',
            'id',
            [
                'alias' => 'MainCategory'
            ]
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'categories';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categories[]|Categories
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categories
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
