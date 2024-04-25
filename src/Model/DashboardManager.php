<?php

namespace App\Model;

use PDO;

class DashboardManager extends AbstractManager
{
    public const TABLE = 'user';
    public const TABLE2 = 'room';
    public const TABLE3 = 'reservation';

    public function selectAll(string $orderBy = 'lastname', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectAllRooms(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT room.id, room.title, room.type, room.bed_type, reservation.isBooked,
         reservation.start_date, reservation.end_date FROM ' . static::TABLE2 . ' LEFT JOIN ' . static::TABLE3 .
         ' ON ' . static::TABLE2 . '.id = ' . static::TABLE3 . '.' . static::TABLE2 . '_id';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function deleteRoom(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE2 . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function insertRoom(array $room): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE2 .
         " (`title`, `description`, `type`, `bed_type`, `isBooked`)
         VALUES (:title, :description, :type, :bed_type, 0)");
        $statement->bindValue('title', $room['title'], PDO::PARAM_STR);
        $statement->bindValue('description', $room['description'], PDO::PARAM_STR);
        $statement->bindValue('type', $room['type'], PDO::PARAM_STR);
        $statement->bindValue('bed_type', $room['bed_type'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
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
