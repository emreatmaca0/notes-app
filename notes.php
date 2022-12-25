<?php

require_once 'db.php';

session_start();

if(!isset($_SESSION['name'])){
   header('location: login');
}

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

$user_id=$_SESSION['user_id'];
$query_num = $dbo->query("SELECT COUNT(*) FROM notes WHERE id='$user_id' ");
$num_rows = $query_num->fetchColumn();
$noteid = [];
$title = [];
$note = [];
$date = [];
$color = [];
if($num_rows>0)
{
            
          
  $query = $dbo->query("SELECT * FROM notes WHERE id='$user_id' ");
  $rows = $query->fetchAll(\PDO::FETCH_ASSOC);
  foreach ($rows as $row) {
    $noteid[]=$row["note_id"];
    $title[]=$row["title"];
    $note[]=$row["note"];
    $date[]=turkish_date_format('j F Y  H:i',$row["date"]);
    $color[] = $row["color"];
  }

  $json_data_1 = json_encode($noteid);
  $json_data_2 = json_encode($title);
  $json_data_3 = json_encode($note);
  $json_data_4 = json_encode($date);
  $json_data_5 = json_encode($color);

}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notew | Notlarım</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="/css/notes.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
</head>

<body>

<nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
      <img src="/images/Notew.png">
    </a>
    <span class="navbar-burger burger" data-target="navbarMenuHeroA">
            <span></span>
            <span></span>
            <span></span>
    </span>
  </div>
        

        
        <div id="navbarMenuHeroA"  class="navbar-menu">
          
        
          <div class="navbar-end">
            
            <div class="navbar-item has-dropdown is-hoverable">

                <a class="navbar-link">
                <span class="material-symbols-outlined" style="margin-right: 5px">waving_hand</span>
                <b>Hoşgeldin <?php echo $_SESSION["name"]; ?>
                </a>
          
                <div class="navbar-dropdown">
                  <a class="navbar-item" href="settings">
                  <span class="material-symbols-outlined" style="margin-right: 5px">settings</span>
                  <b>Ayarlar
                  </a>
                  <a class="navbar-item" href="logout">
                  <span class="material-symbols-outlined" style="margin-right: 5px">logout</span>
                  <b>Çıkış Yap
                  </a>
                </div>
            </div>

          </div>
        </div>
</nav>


<div class="background is-flex is-flex-direction-column is-align-items-center">

<div class="box area" style="background-size: 100% 100%;">

    
  <div name="title" id="aa" class="has-text-centered" style="margin-bottom: 0px; padding: 10px; font-size: 32px; width: 100%; height: min-content; outline: none; border-radius: 15px 15px 0 0; background-color: white; color: black; border-bottom: 1px solid darkgrey;" contenteditable="true">İlk Notum</div>
  <div name="note" style="font-size: 20px; padding:10px; width: 100%; height: min-content; outline: none; border-radius: 0 0 15px 15px; background-color: white; color: black;" contenteditable="true">Not yazmaya başlayın...</div>
  <div class="is-flex is-justify-content-space-around is-align-items-center" style="height: 50px; width: 100%; margin-top: 10px;">
    <div id="white-color" style="width: 25px; height: 25px; border-radius: 50%; border: 1px solid black"><span class="material-symbols-outlined">close</span></div>
    <div id="blue-color"  style="width: 25px; height: 25px; border-radius: 50%; background-color: #67edd9; border: 1px solid black"></div>
    <div id="yellow-color" style="width: 25px; height: 25px; border-radius: 50%; background-color: yellow; border: 1px solid black"></div>
    <div id="transparent-color" style="width: 25px; height: 25px; border-radius: 50%; background-image: url('/images/transparent.jpg'); border: 1px solid black"></div>
  </div>
  <div class="buttons is-centered" id="buttons">
  <button id="save" class="button is-link is-outlined is-centered is-responsive" style="margin-top: 10px;"><span class="material-symbols-outlined" style="margin-right: 5px">save</span>Kaydet</button>
  </div>


</div>

</div>







<div style="margin: 0 auto; padding: 20px;" class="notes_area" id="notes_are"></div>






<script src="/node_modules/tata-js/dist/tata.js"></script>






<script>





//------------------Mobil ekranlarda menüyü küçültür.------------------
$('.navbar-burger').click(function() {
  $('#navbarMenuHeroA, .navbar-burger').toggleClass('is-active');
});
//---------------------------------------------------------------------


//-----------------Not rengi seçim işlemleri----------------------------
$("#white-color").on('click', function(event){
  if($("#white-color").html()=="")
  {
    if($("#blue-color").html()!="")
    {
      $("#blue-color").html("");
    }
    else if($("#yellow-color").html()!="")
    {
      $("#yellow-color").html("");
    }
    else if($("#transparent-color").html()!="")
    {
      $("#transparent-color").html("");
    }
    $("#white-color").html('<span class="material-symbols-outlined">close</span>');
  }
});

$("#blue-color").on('click', function(event){
  if($("#blue-color").html()=="")
  {
    if($("#white-color").html()!="")
    {
      $("#white-color").html("");
    }
    else if($("#yellow-color").html()!="")
    {
      $("#yellow-color").html("");
    }
    else if($("#transparent-color").html()!="")
    {
      $("#transparent-color").html("");
    }
    $("#blue-color").html('<span class="material-symbols-outlined">close</span>');
  }
});

$("#yellow-color").on('click', function(event){
  if($("#yellow-color").html()=="")
  {
    if($("#blue-color").html()!="")
    {
      $("#blue-color").html("");
    }
    else if($("#white-color").html()!="")
    {
      $("#white-color").html("");
    }
    else if($("#transparent-color").html()!="")
    {
      $("#transparent-color").html("");
    }
    $("#yellow-color").html('<span class="material-symbols-outlined">close</span>');
  }
});

$("#transparent-color").on('click', function(event){
  if($("#transparent-color").html()=="")
  {
    if($("#blue-color").html()!="")
    {
      $("#blue-color").html("");
    }
    else if($("#yellow-color").html()!="")
    {
      $("#yellow-color").html("");
    }
    else if($("#white-color").html()!="")
    {
      $("#white-color").html("");
    }
    $("#transparent-color").html('<span class="material-symbols-outlined">close</span>');
  }
});
//------------------------------------------------------------------------------------



//--------Notların ekrana yerleşmesi ile ilgili masonry eklentisi ayarları------------
$('.notes_area').masonry({
  itemSelector: '.note-item',
  gutter: 20,
  fitWidth: true
});
//-------------------------------------------------------------------------------------



//--------Not formatı sadeleştirme işleminden sonra imleci sona alır-------------------
function setCarat(element) {
    
    if (element.type !== "textarea" && element.getAttribute("contenteditable") === "true") {
        element.focus()
        window.getSelection().selectAllChildren(element)
        window.getSelection().collapseToEnd()
    } else {
        
        element.focus()
        element.select()
        window.getSelection().collapseToEnd()
    }
}
//----------------------------------------------------------------------------------------
   


//--------Not formatını sadeleştirme ve notun boyutu değiştinde ekranda yerleştirme işlemleri-----
$(document).keyup(function(event) {
    
    var text = $(event.target).text();
    $(event.target).html("");
    $(event.target).text(text);
    setCarat(event.target);
    $('.notes_area').masonry();

});
//--------------------------------------------------------------------------------------------------


var array=[];
var noteare=document.getElementById("notes_are");
var card_area = document.getElementById("notes_are");
var num_rows=<?=$num_rows?>;

if(num_rows>0){

  var notid=<?php if (!isset($json_data_1)) {echo 0;} else {echo $json_data_1;}?> ;
  var title=<?php if (!isset($json_data_2)) {echo 0;} else {echo $json_data_2;}?> ;
  var notew=<?php if (!isset($json_data_3)) {echo 0;} else {echo $json_data_3;}?> ;
  var date=<?php if (!isset($json_data_4)) {echo 0;} else {echo $json_data_4;}?> ;
  var color=<?php if (!isset($json_data_5)) {echo 0;} else {echo $json_data_5;}?> ;
      
  for (let i = 0; i < num_rows; i++) {
    var card = document.createElement("div");
    card.classList.add("card", "note-item");
    card.id=notid[i];
    card.style.width="300px";
    card.style.marginBottom="40px";
    card.style.backgroundColor=color[i];
    var card_header=document.createElement("header");
    card_header.classList.add("card-header");
    card.appendChild(card_header);
    var card_title=document.createElement("div");
    card_title.classList.add("has-text-centered");
    card_title.style.fontSize="32px";
    card_title.style.color="#1c1c1c";
    card_title.style.width="100%";
    card_title.style.padding="15px";
    card_title.style.outline="none";
    card_title.style.wordBreak="break-word";
    card_title.innerHTML=title[i];
    card_header.appendChild(card_title);
    var note=document.createElement("div");
    note.classList.add("card-content");
    card.appendChild(note);
    var note_content=document.createElement("div");
    note_content.classList.add("content");
    note_content.style.outline="none";
    note_content.style.color="#303030";
    note_content.style.wordBreak="break-word";
    note_content.innerHTML=notew[i];
    note.appendChild(note_content);
    var footer=document.createElement("footer");
    footer.classList.add("card-footer");
    card.appendChild(footer);
    var card_date=document.createElement("p");
    card_date.classList.add("card-footer-item","is-size-7");
    card_date.innerHTML="Son düzenleme:  "+date[i];
    card_date.style.color="#424242";
    footer.appendChild(card_date);
    var footer_action=document.createElement("footer");
    footer_action.classList.add("card-footer");
    card.appendChild(footer_action);
    var card_edit=document.createElement("a");

    card_edit.addEventListener('click', (event) => {
          
      if(event.target.innerText=="Düzenle")
      {
        event.target.innerText="Kaydet";
        event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.contentEditable=true;
        event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.focus();
        event.target.parentElement.parentElement.firstChild.firstChild.contentEditable=true;
      }
      else
      {
        var title=event.target.parentElement.parentElement.firstChild.firstChild.innerHTML;
        var note=event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.innerHTML;
        var id=event.target.parentElement.parentElement.id;
        event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.contentEditable=false;
        event.target.parentElement.parentElement.firstChild.firstChild.contentEditable=false;
        $.ajax
        ({
          url: "notes_edit.php",
          type: "POST",
          data:
          {
          'title': title,
          'note': note,
          'id': id
          },
          success: function (result)
          {
            if (result == "Empty area")
            {

              tata.error('Hata', 'Boş alanları doldurunuz.');
              
            }
            else if (result == "Error")
            {

              tata.error('Hata', 'Bir hata oluştu.');

            }
            else
            {
              event.target.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.innerHTML="Son düzenleme:  "+result;
            } 
          }
        });
        event.target.innerText="Düzenle";
        $('.notes_area').masonry();
      }
          
    });

    card_edit.href="#";
    card_edit.classList.add("card-footer-item");
    card_edit.innerText="Düzenle";
    footer_action.appendChild(card_edit);
    var card_delete=document.createElement("a");

    card_delete.addEventListener('click', (event) => {
      var id=event.target.parentElement.parentElement.id;
      $.ajax
      ({
        url: "notes_delete.php",
        type: "POST",
        data: {
        'id': id
        },
        success: function (result) {
          if (result == "Error")
          {

            tata.error('Hata', 'Bir hata oluştu.');

          }
          else
          {
            var deleted=$('#'+result);
            $('.notes_area').masonry( 'remove', deleted );
            $('.notes_area').masonry();
          }

        }
      });

    });


    card_delete.href="#";
    card_delete.classList.add("card-footer-item");
    card_delete.innerText="Sil";
    footer_action.appendChild(card_delete);
    array[i]=card;
        
  }
      
  var reverse_array=array.reverse();
  reverse_array.forEach(element => {
    noteare.appendChild(element);
  });
      
  $('.notes_area').masonry( 'prepended',reverse_array );
  $('.notes_area').masonry();

}
















$("#buttons").on('click', '#save', function (){
  var title=$("div[name=title]").html();
  var note=$("div[name=note]").html();
  var color="white";
  if($("#white-color").html()!="")
  {
    color="white";
  }
  else if($("#yellow-color").html()!="")
  {
    color="yellow";
  }
  else if($("#transparent-color").html()!="")
  {
    color="transparent";
  }
  else if($("#blue-color").html()!="")
  {
    color="#67edd9";
  }
  $.ajax({
    url: "notes_add.php",
    type: "POST",
    data: {
      'title': title,
      'note': note,
      'color': color
    },
    success: function (result) {
      if (result == "Empty area") 
      {

        tata.error('Hata', 'Boş alanları doldurunuz.');

      } 
      else if (result == "Error") 
      {

        tata.error('Hata', 'Bir hata oluştu.');

      } 
      else 
      {

        var new_note = JSON.parse(result);

        var card = document.createElement("div");
        card.classList.add("card", "note-item");
        card.id=new_note[0];
        card.style.width="300px";
        card.style.marginBottom="40px";
        card.style.backgroundColor=new_note[4];
        var card_header=document.createElement("header");
        card_header.classList.add("card-header");
        card.appendChild(card_header);
        var card_title=document.createElement("div");
        card_title.classList.add("has-text-centered");
        card_title.style.fontSize="32px";
        card_title.style.color="#1c1c1c";
        card_title.style.width="100%";
        card_title.style.outline="none";
        card_title.style.wordBreak="break-word";
        card_title.innerHTML=new_note[1];;
        card_header.appendChild(card_title);
        var note=document.createElement("div");
        note.classList.add("card-content");
        card.appendChild(note);
        var note_content=document.createElement("div");
        note_content.classList.add("content");
        note_content.style.outline="none";
        note_content.style.color="#303030";
        note_content.style.wordBreak="break-word";
        note_content.innerHTML=new_note[2];;
        note.appendChild(note_content);
        var footer=document.createElement("footer");
        footer.classList.add("card-footer");
        card.appendChild(footer);
        var card_date=document.createElement("p");
        card_date.classList.add("card-footer-item","is-size-7");
        card_date.innerHTML="Son düzenleme:  "+new_note[3];
        card_date.style.color="#424242";
        footer.appendChild(card_date);
        var footer_action=document.createElement("footer");
        footer_action.classList.add("card-footer");
        card.appendChild(footer_action);
        var card_edit=document.createElement("a");


        card_edit.addEventListener('click', (event) => {
          
          if(event.target.innerText=="Düzenle")
          {
            event.target.innerText="Kaydet";
            event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.contentEditable=true;
            event.target.parentElement.parentElement.firstChild.firstChild.contentEditable=true;
          }
          else
          {
            var title=event.target.parentElement.parentElement.firstChild.firstChild.innerHTML;
            var note=event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.innerHTML;
            var id=event.target.parentElement.parentElement.id;
            event.target.parentElement.parentElement.firstChild.nextSibling.firstChild.contentEditable=false;
            event.target.parentElement.parentElement.firstChild.firstChild.contentEditable=false;
            $.ajax({
              url: "notes_edit.php",
              type: "POST",
              data: {
                'title': title,
                'note': note,
                'id': id
              },
              success: function (result) {
                if (result == "Empty area") 
                {
                  tata.error('Hata', 'Boş alanları doldurunuz.');

                }
                else if (result == "Error")
                {

                  tata.error('Hata', 'Bir hata oluştu.');

                } 
                else 
                {
                  event.target.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.innerHTML="Son düzenleme:  "+result;
                }


      
              }   
            });
            event.target.innerText="Düzenle";
          }
        
        });


        card_edit.href="#";
        card_edit.classList.add("card-footer-item");
        card_edit.innerText="Düzenle";
        footer_action.appendChild(card_edit);
        var card_delete=document.createElement("a");


        card_delete.addEventListener('click', (event) => {
          var id=event.target.parentElement.parentElement.id;
          $.ajax({
            url: "notes_delete.php",
            type: "POST",
            data: {
              'id': id
            },
            success: function (result) {
              if (result == "Error")
              {

                tata.error('Hata', 'Bir hata oluştu.')

              }
              else 
              {
                var deleted=$('#'+result);
                $('.notes_area').masonry( 'remove', deleted );
                $('.notes_area').masonry();
              }


        
            }
          });




        });


        card_delete.href="#";
        card_delete.classList.add("card-footer-item");
        card_delete.innerText="Sil";
        footer_action.appendChild(card_delete);
        array.push(card);
        reverse_array.unshift(card);
        noteare.appendChild(card);
        $('.notes_area').masonry( 'prepended',card );
        $('.notes_area').masonry();

      }


        
    }
  });

});


</script>




</body>

</html>