<?php

/**
 * @class SessionModel contain main information about curren user session
 */

namespace Fileshare\Models;

class SessionModel
{
    /**
     * @property bool, if true - user authorized now
     */
    private $authorizeStatus = false;
    /**
     * @property int user access lvl
     * 0 - guest
     * 1 - user
     * 2 - moderator
     * 3 - administrator
     */
    private $accessLvl;
    /**
     * @property {string} current user ip address
     */
    private $ip;
    /**
     * @property  SessionModel instance
     */
    private static $sessionModel;

    public function __construct($container)
    {

    }
    /**
     * @param {string} propertyName - name set the property
     * @param {mixed} propertyValue - value set the propery
     * @return {mixed} if property set,  prop value, else false
     */
    public function __set(string $propertyName, $propertyValue)
    {
        if ($propertyName === 'authorizeStatus') {
            return is_bool($propertyValue) ? $this->authorizeStatus = $propertyValue : false;
        } elseif ($propertyName ===  'accessLvl') {
            return is_integer($propertyValue) && $propertyValue > -1 && $propertyValue < 4
                ? $this->accessLvl = $propertyValue : false;
        }
    }

    /**
     * @method delete all class property values
     */
    public function destroySessionData() {
        foreach ($this as $property => $value) {
            unset($this->$property);
        }
    }

    /**
     * @method realize singleton pattern
     * @param $container
     * @return SessionModel
     */
    public static function createSessionModel($container)
    {
        if (empty(self::$sessionModel)) {
            self::$sessionModel = new SessionModel($container);
        }
        return self::$sessionModel;
    }
}
