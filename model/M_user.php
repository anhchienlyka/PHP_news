<?php
include ('database.php');

class M_user extends database
{


    function dangky($name,$mail,$password)
    {
        $sql = "INSERT INTO users(name,email,password) VALUES (?,?,?)";
        $this->setQuery($sql);
        $result = $this->execute( array($name,$mail,md5($password)));//md5 dung de ma hoa password
            if ($result)
            {
                return $this->getLastId();
            }
            else{
                return false;
            }
    }
    public  function dangnhap($email,$md5_password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$md5_password'";
        $this->setQuery($sql);
        return $this->loadAllRows(array($email,$md5_password));
    }
}

?>

