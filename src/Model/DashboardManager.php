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
        $query = 'SELECT * FROM service JOIN reservation ON reservation.id = service.reservation_id JOIN user ON user.id = reservation.user_id JOIN room ON room.id = reservation.room_id ORDER BY ' . $orderBy . ' ' . $direction;

        return $this->pdo->query($query)->fetchAll();
    }

    public function toggleService(array $services)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $breakfast = $services['breakfast'];
            $minibar = $services['minibar'];
            $parking = $services['parking'];
            $service24 = $services['service24'];
            $driver = $services['driver'];
            $userId = $services['user_id'];

            $statement = $this->pdo->prepare("UPDATE service SET ('breakfast', 'minibar', 'parking', 'service24', 'driver') VALUES (:breakfast, :minibar, :parking, :service24, :driver) WHERE id =:id");
            $statement->bindValue(':breakfast', $breakfast['breakfast'], PDO::PARAM_BOOL);
            $statement->bindValue(':minibar', $minibar['minibar'], PDO::PARAM_BOOL);
            $statement->bindValue(':parking', $parking['parking'], PDO::PARAM_BOOL);
            $statement->bindValue(':service24', $service24['service24'], PDO::PARAM_BOOL);
            $statement->bindValue(':driver', $driver['driver'], PDO::PARAM_BOOL);
            $statement->bindValue(':id', $userId['id'], PDO::PARAM_INT);
            $statement->execute();
        }
    }
}
