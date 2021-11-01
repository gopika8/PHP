<?php
class User
{
    private $userName;
    private $userEmail;
    private $userPassword;
    public function setUserName($name)
    {
        $this->userName = $name;
    }
    public function getUserName()
    {
        return $this->userName;
    }
    public function setUserEmail($email)
    {
        $this->userEmail = $email;
    }
    public function getUserEmail()
    {
        return $this->userEmail;
    }
    public function setUserPassword($password)
    {
        $this->userPassword = $password;
    }
    public function getUserPassword()
    {
        return $this->userPassword;
    }
}
?>
