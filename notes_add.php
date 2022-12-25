<?php

require_once 'db.php';

session_start();

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
    $color = $_POST['color'];
    $account=$_SESSION["user_id"];
    if($title!="" || $note!="")
    {
        $query=$dbo->prepare("insert into notes(title,note,id,color) values(?,?,?,?)");
        $add=$query->execute(array($title,$note,$account,$color));
        $last_id = $dbo->lastInsertId();
        $query_get = $dbo->query("SELECT * FROM notes WHERE note_id = '$last_id' ");
        $output = $query_get->fetch(PDO::FETCH_ASSOC);
        $date_turkish = turkish_date_format('j F Y  H:i',$output["date"]);
        $new_note=array("$last_id", "$title", "$note", "$date_turkish","$color");
        if($add)
        {
            echo json_encode($new_note);
            
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