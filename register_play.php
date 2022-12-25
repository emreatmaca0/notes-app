<?php

$cipher='AES-256-ECB';
$key = 'Emre.Atmaca';

require_once 'db.php';

if($_POST){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    if($name!="" && $email!="" && $password!="")
    {
        $query=$dbo->prepare("insert into users(name,email,password,user_type) values(?,?,?,?)");
        $password_encrypt=openssl_encrypt($password,$cipher,$key);
        $add=$query->execute(array($name,$email,$password_encrypt,"user"));
        if($add)
        {
            echo 'Success';
            
        }
        else
        {
            echo 'Error';
        }

    }
    else{
        echo 'Empty area';
    }
}
?>