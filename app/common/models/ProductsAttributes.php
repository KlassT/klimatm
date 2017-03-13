<?php
namespace App\Models;

class ProductsAttributes extends \Phalcon\Mvc\Model
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
    public $product_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $attribute_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $value;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");

        $this->belongsTo(
            'attribute_id',
            'App\Models\Attributes',
            'id',
            [
                'alias' => 'Attribute'
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
        return 'products_attributes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductsAttributes[]|ProductsAttributes
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductsAttributes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
