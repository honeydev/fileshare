<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 11:29 PM
 */

namespace Fileshare\Models;

abstract class AbstractModel
{
    /**
     * @method universal getter
     * @return mixed
     */
    public function __get(string $propertyName)
    {
        if (property_exists($this, $propertyName)) {
            return $this->$propertyName;
        }
        throw new \InvalidArgumentException(
            "Incorrect session variable [{$propertyName}] in class " . get_class($this)
        );
    }

    public function getAllProperties(): array
    {
        $properties = [];
        foreach ($this as $propertyName => $propertyValue) {
            $properties[$propertyName] = $propertyValue;
        }
        return $properties;
    }
}
