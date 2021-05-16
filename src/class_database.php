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

    public function userInsert($user)
    {
        $key = sha1($user->getEmail()).time();
        $key = sha1($key).time().time();
        $pseudo = $user->getPseudo();
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);

        $request = $this->db->prepare('INSERT INTO `users` (`users_pseudo`, `users_email`, `users_password`, `users_key`) VALUES (:user_pseudo, :user_email, :user_password, :user_key)');
        $request->bindParam(':user_pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $request->bindParam(':user_email', $email, PDO::PARAM_STR);
        $request->bindParam(':user_password', $password, PDO::PARAM_STR);
        $request->bindParam(':user_key', $key, PDO::PARAM_STR);
        $request->execute();
    }

    public function getUser($email)
    {
        $request = $this->db->prepare('SELECT * FROM `users` WHERE `users_email` = :users_email');
        $request->bindParam(':users_email', $email, PDO::PARAM_STR);
        $request->execute();

        return $request->fetch(PDO::FETCH_OBJ);
    }

}
