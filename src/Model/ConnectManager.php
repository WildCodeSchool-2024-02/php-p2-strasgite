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

    public function insert(array $credentials): string
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
        return $this->pdo->lastInsertId();
    }

    public function edit(array $user): int
    {
        $statement = $this->pdo->prepare("UPDATE " . static::TABLE .
            " SET `firstname` = :firstname, `lastname` = :lastname,
            `address` = :address, `email` = :email, `password` = :password
            WHERE id = :id");
        $statement->bindValue(':firstname', $user['firstname']);
        $statement->bindValue(':lastname', $user['lastname']);
        $statement->bindValue(':address', $user['address']);
        $statement->bindValue(':email', $user['email']);
        $statement->bindValue(':password', $user['password']);
        $statement->bindValue(':id', $user['id']);
        $statement->execute();
        return $user['id'];
    }
}
