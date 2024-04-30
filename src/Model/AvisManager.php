<?php

namespace App\Model;

use PDO;

class AvisManager extends AbstractManager
{
    public const TABLE = 'avis';

    public function updateAvisIsVisible(int $id, bool $statut): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `isVisible` = :isVisible WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->bindValue('isVisible', $statut, PDO::PARAM_BOOL);

        return $statement->execute();
    }

    public function updateLesAvisIsVisible(int $id, bool $statut): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `isVisible` = :isVisible
        WHERE avis_room_id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->bindValue('isVisible', $statut, PDO::PARAM_BOOL);

        return $statement->execute();
    }

    public function selectAvis(int $id)
    {
        $statement = $this->pdo->prepare("SELECT *, avis.id AS id_avis FROM " . self::TABLE .
        " JOIN user u ON avis_user_id=u.id WHERE avis_room_id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectVisibleAvis(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE .
        " JOIN user u ON avis_user_id=u.id WHERE isVisible=true and avis_room_id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function addNewAvis($description, $roomId, $userId)
    {
        $query = "INSERT INTO " . static::TABLE . "(description, avis_room_id, avis_user_id, isVisible)
        VALUES (:description, :avis_room_id, :avis_user_id, 1)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':avis_room_id', $roomId);
        $statement->bindValue(':avis_user_id', $userId);
        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    public function deleteAvis($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
