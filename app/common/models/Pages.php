<?php
namespace App\Models;

class Pages extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=255 nullable=false)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $content;

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
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pages';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pages[]|Pages
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pages
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
