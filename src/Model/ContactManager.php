<?php

namespace App\Model;

use PDO;

class ContactManager extends AbstractManager
{
    public const TABLE = 'contact';

    /**
     * Insert new contact in database
     */
    public function insert(array $contact): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (lastname, firstname, email, subject, message)
            VALUES (:lastname, :firstname, :email, :subject, :message)");
        $statement->bindValue(':lastname', $contact['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':firstname', $contact['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':email', $contact['email'], PDO::PARAM_STR);
        $statement->bindValue(':subject', $contact['subject'], PDO::PARAM_STR);
        $statement->bindValue(':message', $contact['message'], PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
