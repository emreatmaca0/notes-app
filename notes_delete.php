<?php

require_once 'db.php';

session_start();
date_default_timezone_set('Europe/Istanbul');



if($_POST)
{
    
    $id=$_POST['id'];
    $account=$_SESSION["user_id"];
    $query=$dbo->prepare("DELETE FROM notes WHERE note_id=?");
    $add = $query->execute(array($id));
    if($add)
    {
        echo $id;
            
    }
    else
    {
        echo 'Error';
    }
  
}
?>