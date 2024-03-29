<?php
include_once 'ICrud.php';

class Crud implements ICrud {
    protected $conn;

    public function connect() {
        $db_host = '127.0.0.1';     //Something something ip config (makes website fast)
        $db_username = 'sql_manager';
        $db_password = 'lookatmeimastrongpassword';
        $db_name = 'dinostaur';

        $this->conn = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_username, $db_password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Disables automatic stringifying
        $this->conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        return $this;
    }

    public function setup($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key=>$value) {
            $stmt->bindValue($key, $value);
        }
        return $stmt;
    }

    public function create($sql, $params) {
        $stmt = $this->setup($sql, $params);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function read($sql, $params) {
        $stmt = $this->setup($sql, $params);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update($sql, $params) {
        $stmt = $this->setup($sql, $params);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function delete($sql, $params) {
        $stmt = $this->setup($sql, $params);
        return $stmt->execute();
    }

    public function userByEmail($email) {
        $params = array(':email'=>$email);
        $result = $this->read('SELECT * FROM users WHERE email = :email', $params);
        return $result ? $result[0] : $result;
    }
}
