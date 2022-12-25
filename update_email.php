<?php



require_once 'db.php';

session_start();



if($_POST){
    $email=$_POST['email'];
    $account=$_SESSION["user_id"];
    if($email!="")
    {
        //UPDATE users SET name=?, surname=?, sex=? WHERE id=?
        $query=$dbo->prepare("UPDATE users SET email=? WHERE id=?");
        $add=$query->execute(array($email,$account));
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