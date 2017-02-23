<?php

namespace Eden\MealOrder\Services;

use Doctrine\DBAL\Connection;

class DemoUsersFinder
{
    /** @var  Connection */
    private $connection;

    /**
     * DemoUsersFinder constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $name
     * @return array
     */
    public function getUsersByName($name)
    {
        $sql = "SELECT * FROM users WHERE name = :name";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('name', $name);
        $stmt->execute();

        $users = [];
        while($user = $stmt->fetch()) {
            $users[] = $user;
        }

        return $users;
    }
}