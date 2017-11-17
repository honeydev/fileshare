<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 17/11/17
 * Time: 23:10
 */

namespace Fileshare\Models;


abstract class AbstractUserModel extends AbstractModel
{
    /** @property string */
    protected $email;
    /** @property string */
    protected $name;
    /** @property array */
    protected $priveleges;
}