<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 17/11/17
 * Time: 23:10
 */
declare(strict_types=1);

namespace Fileshare\Models;

abstract class AbstractUserModel extends AbstractModel
{
    /** @property string */
    protected $email;
    /** @property string */
    protected $name;
    /** @property array */
    protected $privileges;

    public function __set($propertyName, $propertyValue)
    {
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $propertyValue;
        }
        throw new \InvalidArgumentException("In class " . get_class($this) . " not exist property {$propertyName}");
    }
}
