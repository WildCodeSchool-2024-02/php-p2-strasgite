<?php

namespace App\Model;

use PDO;

class RoomsManager extends AbstractManager
{
    public const TABLE = 'rooms';

    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `name` = :name, `description` = :description WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('name', $item['name'], PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], PDO::PARAM_STR);
        return $statement->execute();
    }
}
