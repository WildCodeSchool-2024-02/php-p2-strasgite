<?php

namespace App\Model;

use PDO;

class DashboardManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectAll(string $orderBy = 'lastname', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function toggleUser0(array $item, string $column): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET " . $column . "= 0 WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);

        return $statement->execute();
    }

    public function toggleUser1(array $item, string $column): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET " . $column . "= 1 WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);

        return $statement->execute();
    }

    public function deleteUser(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
