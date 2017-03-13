<?php
namespace App\Models;

class Slider extends \Phalcon\Mvc\Model
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
    public $image;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    public $link_type;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $link;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $sort;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'slider';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Slider[]|Slider
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Slider
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
