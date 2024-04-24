<?php

namespace App\Model;

use PDO;

class DashboardManager extends AbstractManager
{
    public const TABLE = 'user';
    public const TABLE2 = 'room';

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
        $query = 'SELECT * FROM ' . static::TABLE2;
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

    public function selectAllreservation(string $orderBy = 'reservation_id', string $direction = 'DESC'): array
    {
        $query = 'SELECT * FROM service JOIN reservation';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function toggleService(array $reservation, string $service)
    {
        $statement = $this->pdo->prepare("UPDATE service SET " . $service . "= 1 WHERE id=:id");
        $statement->bindValue('id', $reservation['id'], PDO::PARAM_INT);
    }
}
