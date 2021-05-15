<?php

class User
{

    private $pseudo;
    private $email;
    private $password;
    private $confirmPassword;

    public function __construct(string $pseudo, string $email, string $password, string $confirmPassword)
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;    
    }

    public function passwordControl()
    {
        if ($this->password === $this->confirmPassword) {
            return true;
        }
        else{
            return false;
        }
    }


    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }
}

