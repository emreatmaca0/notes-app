<?php

$cipher='AES-256-ECB';// Şifreleme Algoritması
$key = 'Emre.Atmaca';// Şifreleme Anahtarı

require_once 'db.php';
session_start();

if($_POST){
    $email=$_POST['email'];
    $password=$_POST['password'];
    if($email!="" && $password!="")
    {
        //E-posta ve şifre veritabanındaki kayıtlarla karşılaştırılır ve yönlendirme yapılır
        $password_encrypt=openssl_encrypt($password,$cipher,$key);
        $query_num = $dbo->query("SELECT COUNT(*) FROM users WHERE email = '$email' && password = '$password_encrypt'");
        $num_rows = $query_num->fetchColumn();
        $query = $dbo->query("SELECT * FROM users WHERE email = '$email' && password = '$password_encrypt'");
        $output = $query->fetch(PDO::FETCH_ASSOC);
        if($num_rows>0)
        {
            
            if($output['user_type'] == 'user'){

                $_SESSION['name'] = $output['name'];
                $_SESSION['user_id'] = $output['id'];

            }
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
