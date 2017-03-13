<?php

namespace App\Models;

class Admins extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=60, nullable=false)
     */
    public $login;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $password;

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
        return 'admins';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admins[]|Admins
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admins
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
