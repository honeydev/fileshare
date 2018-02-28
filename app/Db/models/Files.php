<?php
/**
 * @class Files
 */

declare(strict_types=1);

namespace Fileshare\Db\models;

class Files
{
    /**
     * @const array
     */
     private $FILE_COLUMNS = ['name', 'size', 'author', 'publishDate', 'format', 'ownerId', 'id', 'uri'];
    /** @property \Pdo */
    private $db;

    public function __construct($container)
    {
        $this->db = $container->get('db');
    }

    public function __call($methodName, $args)
    {
        if (method_exists($this, $methodName)) {
            return $this->$methodName(...$args);
        }
        throw new \InvalidArgumentException("Method ${$methodName} not exist");
    }
    /**
     * @param array $columnValuesArray 2-d array like
     * [
     *      ['columnName_0' => 'columnValue_0'],
     *      ['columnName_1' => 'columnValue_1']
     * ]
     * @throws \Fileshare\Exceptions\DatabaseException
     */
    private function checkColumnsOnExistInDb(array $columnValuesArrays)
    {
        foreach ($columnValuesArrays as $columnValueArray) {
            foreach ($columnValueArray as $columnName) {
                $this->checkColumnOnExist($columnName);
            }
        }
    }
    /**
     * @throws \Fileshare\Exceptions\DatabaseException
     */
    private function checkColumnOnExist(string $columnName)
    {
        if (!array_key_exists($columnName, $this->fileColumns)) {
            throw new \Fileshare\Exceptions\DatabaseException("Column {$columnName} not exist in table" . __CLASS__);
        }
    }
}
