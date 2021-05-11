<?php

namespace App\Model;

class MessageManager extends AbstractManager
{

    public const TABLE = 'message';

    public function insert($firstname, $message): string
    {
        $query = 'INSERT INTO message (firstname, message)
                    VALUES (:firstname, :message);';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':message', $message, \PDO::PARAM_STR);



        $statement->execute();


        return $this->pdo->lastInsertId();
    }
}
