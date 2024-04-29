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
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE avis_room_id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectVisibleAvis(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE isVisible=true and avis_room_id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll();
    }
}
