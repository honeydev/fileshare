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
     */
    public function __get(string $propertyName)
    {
        if (property_exists($this, $propertyName)) {
            return $this->$propertyName;
        }
        throw new \InvalidArgumentException(
            "Incorrect session variable [{$propertyName}] in class " . get_parent_class($this)
        );
    }
}
