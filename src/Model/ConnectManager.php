<?php

namespace App\Model;

use PDO;

class ConnectManager extends AbstractManager
{
    public const TABLE = 'user';

    public function getOneByEmail(string $email)
    {
        {
            // prepared request
            $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
            $statement->bindValue('email', $email, \PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetch();
        }
    }

    public function insert(array $credentials): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE .
            " (`firstname`, `lastname`, `address`, `email`, `password`)
            VALUES (:firstname, :lastname, :address, :email, :password)");
        $statement->bindValue(':firstname', $credentials['firstname']);
        $statement->bindValue(':lastname', $credentials['lastname']);
        $statement->bindValue(':address', $credentials['address']);
        $statement->bindValue(':email', $credentials['email']);
        $statement->bindValue(':password', $credentials['password']);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
