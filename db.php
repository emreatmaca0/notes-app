<?php


//Veritabanı bağlantısı 
try{
    $dbo=new PDO(dsn: "mysql:host=localhost;dbname=notew_db;charset=utf8",username: "root", password: "");
}
catch(Exception $e){
    print $e->getMessage();

    
}