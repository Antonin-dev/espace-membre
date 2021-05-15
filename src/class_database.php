<?php

class Database
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
    }

    public function emailControl($email)
    {
        $request = $this->db->prepare('SELECT COUNT(*) FROM `users` WHERE `users_email` = :email');
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->execute();

        return $request->fetch(PDO::FETCH_ASSOC);
    }

}
