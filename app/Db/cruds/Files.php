<?php
/**
 * @class Files
 */

declare(strict_types=1);

namespace Fileshare\Db\cruds;


trait Files
{
    private function addFile(array $fileData)
    {
        $query = "INSERT INTO files (name, size, author, publishDate, format, ownerId, id, uri)
            VALUES (:email, :size, :author, NULL, :format, :ownerId, NULL, :uri)";
        $query = $this->db->prepare($query);
        $query->execute(array($fileData));
        return $this->db->lastInsertId();
    }

    private function selectFilesById(string $id)
    {
        $query = "SELECT * FROM files WHERE id = '$id'";
    }

    private function changeFile(array $columnAndValues)
    {

    }

    private function deleteFile(string $id)
    {
        $query = "DELETE FROM files WHERE id = '$id'";
        $this->db->query($query);
    }
}
