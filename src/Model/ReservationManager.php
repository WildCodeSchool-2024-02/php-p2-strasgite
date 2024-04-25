<?php

namespace App\Model;

use PDO;

class ReservationManager extends AbstractManager
{
    public const TABLE = 'reservation';

    public function selectBooked(int $id): array
    {
        $query = "SELECT DATE(start_date) AS start_date, DATE(end_date) AS end_date FROM " . static::TABLE . "
        WHERE isBooked = 1 AND room_id = :room_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':room_id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function insert($startDate, $endDate, $room, $userId): string
    {
        $query = "INSERT INTO " . static::TABLE . " (start_date, end_date, room_id, user_id, isBooked) VALUES
        (:start_date, :end_date, :room_id, :user_id, 1)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':user_id', $userId);
        $statement->bindValue(':room_id', $room, PDO::PARAM_INT);
        $statement->bindValue(':start_date', $startDate);
        $statement->bindValue(':end_date', $endDate);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function insertservice(int $id): string
    {
        $query ="INSERT INTO service (reservation_id, breakfast, minibar, parking, service24, driver) 
                VALUES (:reservation_id, 0, 0, 0, 0, 0)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':reservation_id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
}
