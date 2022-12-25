<?php

require_once 'db.php';

session_start();
date_default_timezone_set('Europe/Istanbul');

function turkish_date_format($format, $datetime = 'now'){
    $z = date("$format", strtotime($datetime));
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
  }

if($_POST){
    $title=$_POST['title'];
    $note=$_POST['note'];
    $id=$_POST['id'];
    $account=$_SESSION["user_id"];
    if($title!="" || $note!="")
    {
        $query=$dbo->prepare("UPDATE notes SET title=?, note=?, date=? WHERE note_id=?");
        $add = $query->execute(array($title, $note, date('Y-m-d H:i:s'),$id));
        $query_get = $dbo->query("SELECT * FROM notes WHERE note_id = '$id' ");
        $output = $query_get->fetch(PDO::FETCH_ASSOC);
        $date_turkish = turkish_date_format('j F Y  H:i',$output["date"]);
        if($add)
        {
            echo $date_turkish;
            
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