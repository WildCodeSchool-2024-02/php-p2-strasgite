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

    public function getReservationById(int $id)
    {
        $query = "SELECT reservation.id, u.firstname, u.lastname, room.title,
        reservation.start_date, reservation.end_date,
        DATE_FORMAT(reservation.start_date, '%d %M %Y') AS start,
        DATE_FORMAT(reservation.end_date, '%d %M %Y') AS end FROM " . static::TABLE .
        " JOIN user AS u ON u.id = reservation.user_id
        JOIN room ON room.id = reservation.room_id WHERE u.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getAllReservation()
    {
        $query = "SELECT reservation.id, u.firstname, u.lastname, r.title,
        DATE_FORMAT(reservation.start_date, '%d %M %Y') AS start,
        DATE_FORMAT(reservation.end_date, '%d %M %Y') AS end FROM " . static::TABLE .
        " JOIN user AS u ON u.id = reservation.user_id
        JOIN room AS r ON r.id = reservation.room_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function getReservationByItsId(int $id)
    {
        $query = "SELECT * FROM " . static::TABLE . " WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function editReservation($startDate, $endDate, $id)
    {
        $query = "UPDATE " . static::TABLE . " SET start_date = :start_date, end_date = :end_date WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':start_date', $startDate);
        $statement->bindValue(':end_date', $endDate);
        $statement->execute();
    }
}
