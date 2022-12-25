<?php

$cipher='AES-256-ECB';
$key = 'Emre.Atmaca';

require_once 'db.php';

session_start();

if($_POST){
    $account=$_SESSION["user_id"];
    $oldpassword=$_POST['oldpassword'];
    $password=$_POST['password'];
    if($oldpassword!="" && $password!="")
    {
        $password_encrypt=openssl_encrypt($oldpassword,$cipher,$key);
        $query_num = $dbo->query("SELECT COUNT(*) FROM users WHERE id = '$account' && password = '$password_encrypt'");
        $num_rows = $query_num->fetchColumn();
        if ($num_rows > 0) 
        {
                $query=$dbo->prepare("UPDATE users SET password=? WHERE id=?");
                $password_encrypt=openssl_encrypt($password,$cipher,$key);
                $add=$query->execute(array($password_encrypt,$account));
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
            echo 'Wrong Password';
        }
        

    }
    else{
        echo 'Empty area';
    }
}
?>