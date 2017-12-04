<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 17/11/17
 * Time: 23:10
 */
declare(strict_types=1);

namespace Fileshare\Models;

abstract class AbstractUserModel extends AbstractModel implements UserInerface
{
    /** @property string */
    protected $email;
    /** @property string */
    protected $name;
    /** @proerty string */
    protected $avatarUri;
    /** @property array */
    protected $privileges;

    public function __set($propertyName, $propertyValue)
    {
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $propertyValue;
        }
        throw new \InvalidArgumentException("In class " . get_class($this) . " not exist property {$propertyName}");
    }

    public function getUserProperty(string $propertyName): string
    {  if (property_exists($this, $propertyName)) {
            return $this->$propertyName;
        }
        throw new \InvalidArgumentException(`property {$propertyName} in class ` . get_class($this) . `not extists!`);
    }
}
