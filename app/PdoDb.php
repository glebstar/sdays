<?php

namespace App;

class PdoDb
{
    private static $_connect = null;

    public static function getConnect()
    {
        if (!empty(self::$_connect)) {
            return self::$_connect;
        }

        self::$_connect = new \PDO('mysql:host=' . config('database.connections.mysql.host') . ';dbname=' . config('database.connections.mysql.database'), config('database.connections.mysql.username'), config('database.connections.mysql.password'), array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        return self::$_connect;
    }

    public static function getOne($sql, $bind = []) {
        $connect = self::getConnect()->prepare($sql);
        $connect->execute($bind);
        $res = $connect->fetch();
        if ( $res ) {
            return $res[0];
        }

        return false;
    }

    public static function getAll($sql, $bind = []) {
        $connect = self::getConnect()->prepare($sql);
        $connect->execute($bind);
        return $connect->fetchAll(\PDO::FETCH_ASSOC);
    }
}