<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 17/11/17
 * Time: 23:10
 */
declare(strict_types=1);

namespace Fileshare\Models;

abstract class AbstractUserModel extends AbstractModel implements UserInterface
{
    /** @property string */
    protected $accessLvl;
    /** @property array */
    protected $privileges;

    /** @return void */
    public function __set($propertyName, $propertyValue)
    {
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $propertyValue;
            return null;
        }
        throw new \InvalidArgumentException("In class " . get_class($this) . " not exist property {$propertyName}");
    }
    /** @return void */
    public function setUserVars(array $userData)
    {
        foreach ($userData as $propertyName => $value) {
            if (property_exists($this, $propertyName)) {
                $this->$propertyName = $userData[$propertyName];
            }
        }
    }
}
