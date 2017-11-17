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
    protected $authorizeStatus = false;
    /**
     * @property int user access lvl
     * 0 - guest
     * 1 - user
     * 2 - moderator
     * 3 - administrator
     */
    protected $accessLvl;
    /**
     * @property {string} current user ip address
     */
    protected $ip;

    private static $sessionModel;

    private $sessionValidator;

    public function __construct($container)
    {
       $this->sessionValidator = $container->get('SessionModelValidator');
    }

    public function destroySessionData() {
        foreach ($this as $property => $value) {
            unset($this->$property);
        }
    }

    public function __set(string $propertyName, $propertyValue)
    {
        $this->sessionValidator->validate([
            'propertyName' => $propertyName,
            'propertyValue' =>$propertyValue
        ]);
        $this->$propertyName = $propertyValue;
    }

    /**
     * @method realize singleton pattern
     */
    public static function createSessionModel($container)
    {
        if (empty(self::$sessionModel)) {
            self::$sessionModel = new SessionModel($container);
        }
        return self::$sessionModel;
    }
}
