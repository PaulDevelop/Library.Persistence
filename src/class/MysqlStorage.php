<?php

namespace Com\PaulDevelop\Library\Persistence;

abstract class MysqlStorage {
    private $host;
    private $user;
    private $password;
    private $database;

    private static $connection = null;

    protected function __construct($host = '', $user = '', $password = '', $database = '')
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    protected function getConnection() {
        if (self::$connection == null) {
            self::$connection = new \mysqli(
                $this->host,
                $this->user,
                $this->password,
                $this->database
            );
        }

        return self::$connection;
    }
}
