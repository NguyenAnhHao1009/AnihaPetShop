<?php

namespace App;

use \PDO;

class User
{

    private ?PDO $db;

    private string $user_name;
    private string $email;
    private string $password;
    private string $phone_number;
    private string $address;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }



    public function getInfoById($user_id): array
    {
        $statement = $this->db->prepare('select * from users where user_id = :user_id');
        $statement->execute([':user_id' => $user_id]);
        $user = $statement->fetch();
        if (empty($user)) {
            return false;
        }
        return $user;
    }

    public function isExistEmail(string $email): bool
    {

        $statement = $this->db->prepare('select * from users where email = :email');
        $statement->execute([':email' => $email]);
        $user = $statement->fetch();
        if (!empty($user)) {
            return true;
        }
        return false;
    }


    public function isExistPhoneNumber(string $phone_number)
    {
        $statement = $this->db->prepare('select * from users where phone_number = :phone_number');
        $statement->execute([':phone_number' => $phone_number]);
        $user = $statement->fetch();
        if (!empty($user)) {
            return true;
        }
        return false;
    }


    public function isExistEmailExceptThis(string $email, $id): bool
    {
        $statement = $this->db->prepare('select * from users where email = :email and user_id != :user_id');
        $statement->execute([
            ':email' => $email,
            ':user_id' => $id
        ]);
        $user = $statement->fetch();
        if (!empty($user)) {
            return true;
        }
        return false;
    }

    public function isExistPhoneNumberExceptThis(string $phone_number, $id): bool
    {
        $statement = $this->db->prepare('select * from users where phone_number = :phone_number and user_id != :user_id');
        $statement->execute([
            ':phone_number' => $phone_number,
            ':user_id' => $id
        ]);
        $user = $statement->fetch();
        if (!empty($user)) {
            return true;
        }
        return false;
    }

    public function all(): array
    {
        $sql = 'select user_id, user_name, email, phone_number, address, is_admin  from users ';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        if (!empty($rows)) {
            return $rows;
        }
        return null;
    }

    public function searchByUserName($name)
    {
        $sql = 'select user_id, user_name, email, phone_number, address, is_admin from users where user_name like ?;';
        $statement = $this->db->prepare($sql);
        $statement->execute(["%$name%"]);
        $rows = $statement->fetchAll();
        if (!empty($rows)) {
            return $rows;
        }
        return null;
    }

    public function fill($data): User
    {
        $this->user_name = $data['user_name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->phone_number = $data['phone_number'];
        $this->address = $data['address'];
        return $this;
    }

    public function add(): bool
    {
        try {
            $sql = 'INSERT INTO users (user_name, email, password, phone_number, address) VALUES (:user_name, :email, :password, :phone_number, :address)';
            $statement = $this->db->prepare($sql);
            $statement->execute([
                ':user_name' => $this->user_name,
                ':email' => $this->email,
                ':password' => md5($this->password),
                ':phone_number' => $this->phone_number,
                ':address' => $this->address,
            ]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function find($email, $password): bool
    {
        $sql = 'SELECT * FROM users WHERE email = ? and password = ?';
        $statement = $this->db->prepare($sql);
        $statement->execute([$email, md5($password)]);
        $info = $statement->fetch();
        if (!empty($info)) {
            return true;
        }
        return false;
    }

    public function checkPass($password, $user_id): bool
    {
        $sql = 'SELECT * FROM users WHERE user_id = :user_id and password = :password';
        $statement = $this->db->prepare($sql);
        $statement->execute([':user_id' => $user_id, ':password' => md5($password)]);
        $info = $statement->fetch();
        if (!empty($info)) {
            return true;
        }
        return false;
    }


    public function fillByEmailAndPass($email, $pass): ?User
    {
        $sql = 'SELECT * FROM users WHERE email = ? and password = ?';
        $statement = $this->db->prepare($sql);
        $statement->execute([$email, md5($pass)]);
        $info = $statement->fetch();
        if (!empty($info)) {
            return new User($this->db);
        }
        return null;
    }

    public function getAdminId($email, $pass): array
    {
        $isAd_Id = [];
        $sql = 'SELECT * FROM users WHERE email = ? and password = ?';
        $statement = $this->db->prepare($sql);
        $statement->execute([$email, md5($pass)]);
        $info = $statement->fetch();
        $isAd_Id['is_admin'] = $info['is_admin'];
        $isAd_Id['user_id'] = $info['user_id'];
        return $isAd_Id;
    }

    public function countNumberOfUsers(): int
    {
        $sql = 'select count(*) as num_users from users where is_admin = 0';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $num_users = $statement->fetch();
        return $num_users['num_users'];
    }

    public function update($user_id, $data): bool
    {
        $this->user_name = $data['user_name'];
        $this->email = $data['email'];
        $this->phone_number = $data['phone_number'];
        $this->address = $data['address'];
        $this->password = $data['password'];

        if (empty($data['password'])) {
            try {
                $sql = 'UPDATE users SET user_name = :user_name, email = :email, phone_number = :phone_number, address = :address WHERE user_id = :user_id';
                $statement = $this->db->prepare($sql);

                if ($statement->execute([
                    ':user_name' => $this->user_name,
                    ':email' => $this->email,
                    ':phone_number' => $this->phone_number,
                    ':address' => $this->address,
                    ':user_id' => $user_id
                ])) {
                    return true;
                }
            } catch (\PDOException $e) {
                return false;
            }
        } else {
            try {
                $sql = 'UPDATE users SET user_name = :user_name, email = :email, phone_number = :phone_number, address = :address, password = :password WHERE user_id = :user_id';
                $statement = $this->db->prepare($sql);

                if ($statement->execute([
                    ':user_name' => $this->user_name,
                    ':email' => $this->email,
                    ':phone_number' => $this->phone_number,
                    ':address' => $this->address,
                    ':password' => md5($this->password),
                    ':user_id' => $user_id
                ])) {
                    return true;
                }
            } catch (\PDOException $e) {
                return false;
            }
        }
    }
}
