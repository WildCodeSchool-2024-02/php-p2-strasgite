<?php

namespace App\Model;

use PDO;

class RoomManager extends AbstractManager
{
    public const TABLE = 'room';

    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `title` = :title, `description` = :description WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['name'], PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], PDO::PARAM_STR);
        return $statement->execute();
    }
}
