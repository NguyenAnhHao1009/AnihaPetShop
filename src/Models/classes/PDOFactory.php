<?php

namespace App;

use PDO;

class PDOFactory
{
    // public function create(array $config): PDO
    // {
    //     [
    //         'dbhost' => $dbhost,
    //         'dbname' => $dbname,
    //         'dbuser' => $dbuser,
    //         'dbpass' => $dbpass
    //     ] = $config;
    //     $dsn = "mysql:host={$dbhost};dbname={$dbname}";
    //     $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    //     $PDO =  new PDO($dsn, $dbuser, $dbpass, $options);
    //     print_r($PDO) ;
    //     return $PDO;
    // }
    public function create(array $config): PDO
    {
        try {
            [
                'dbhost' => $dbhost,
                'dbname' => $dbname,
                'dbuser' => $dbuser,
                'dbpass' => $dbpass
            ] = $config;

            $dsn = "mysql:host={$dbhost};dbname={$dbname}";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $PDO = new PDO($dsn, $dbuser, $dbpass, $options);
            return $PDO;
        } catch (\PDOException $ex) {
            echo 'Lỗi khi tạo kết nối PDO: ' . $ex->getMessage();
            throw $ex;
        }
    }

    public function echo()
    {
        echo 'NẠp lớp oki';
    }
}
