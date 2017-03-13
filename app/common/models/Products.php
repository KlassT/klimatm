<?php
namespace App\Models;

use Carbon\Carbon;
use Phalcon\Mvc\Model\Relation;

class Products extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $category_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $brand_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $sale_price;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $updated_at;

    /**
     *
     * @var string
     * @Column(type="string", length=225, nullable=false)
     */
    public $uri;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $views;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");

        $this->hasMany('id', 'App\Models\Cart', 'product_id', [
            'alias' => 'InCart'
        ]);

        $this->belongsTo(
            'category_id',
            'App\Models\Categories',
            'id',
            [
                'alias' => 'Category'
            ]
        );

        $this->belongsTo(
            'brand_id',
            'App\Models\Brands',
            'id',
            [
                'alias' => 'Brand'
            ]
        );

        $this->hasOne(
            'id',
            'App\Models\Images',
            'product_id',
            [
                'alias' => 'Image',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );

        $this->hasMany(
            'id',
            'App\Models\ProductsAttributes',
            'product_id',
            [
                'alias' => 'Attributes'
            ]
        );

        $this->skipAttributesOnCreate(
            [
                "created_at",
                "updated_at",
                "views"
            ]
        );

        $this->skipAttributesOnUpdate(
            [
                "updated_at",
                "views"
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
        return 'products';
    }

    public function beforeCreate()
    {
        $this->created_at = (string)Carbon::now();
        $this->updated_at = (string)Carbon::now();
        $this->views = 0;
    }

    public function beforeUpdate()
    {
        $this->updated_at = (string)Carbon::now();
    }


    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products[]|Products
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
