<?php

// PHP Object Oriented Programming

class Database
{

    public static $connection; // now we can access this variable in any part of the project through Database object

    public static function setUpConnection()
    {

        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "password", "lms", "3306");
        }

    }

    public static function iud($query)
    {

        // iud --> InsertUpdateDelete
        Database::setUpConnection();
        Database::$connection->query($query);

    }

    public static function search($query)
    {

        Database::setUpConnection();
        $resultSet = Database::$connection->query($query);
        return $resultSet;

    }

}

?>