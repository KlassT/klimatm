<?php
namespace App\Models;

use Carbon\Carbon;

class News extends \Phalcon\Mvc\Model
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
    public $category;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $image;

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
     * @Column(type="string", length=255, nullable=false)
     */
    public $uri;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");

        $this->skipAttributesOnCreate(
            [
                "created_at",
                "updated_at"
            ]
        );

        $this->skipAttributesOnUpdate(
            [
                "updated_at"
            ]
        );
    }

    public function beforeCreate()
    {
        $this->created_at = (string)Carbon::now();
        $this->updated_at = (string)Carbon::now();
    }

    public function beforeUpdate()
    {
        $this->updated_at = (string)Carbon::now();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'news';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return News[]|News
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return News
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
