<?php

require_once 'db.php';

session_start();

if(!isset($_SESSION['name'])){
   header('location: login');
}


?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notew | Ayarlar</title>
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
<body class="has-navbar-fixed-top">

<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
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

<div class="box area">


<a href="notes" style="margin-bottom: 50px;"><span class="material-symbols-outlined">arrow_back</span></a>

<h1 class="title has-text-centered">Kullanıcı Ayarları</h1>



<div class="tabs is-centered">
    <ul>
      <li id="all-tab" class="is-active">
        <a onClick="switchToAll()">
        <span class="icon is-small"><span class="material-symbols-outlined">mail</span></span>
        <span>E-posta'nı değiştir</span>
      </a>
      </li>
      <li id="password-tab">
        <a onClick="switchToPassword()">
        <span class="icon is-small"><span class="material-symbols-outlined">password</span></span>
        <span>Şifre'ni değiştir</span>
      </a>
      </li>
      <li id="notifications-tab">
        <a onClick="switchToNotifications()">
        <span class="icon is-small"><span class="material-symbols-outlined">notifications</span></span>
        <span>Bildirimler</span>
      </a>
      </li>
      
    </ul>
    
  </div>

  <div class="container">
    <div id="all-tab-content">
      
      <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">E-posta</label>
  </div>
  <div class="field-body">
    <div class="field">
      <p class="control">
        <input id="email" class="input is-rounded" type="email" placeholder="E-posta adresiniz">
      </p>
    </div>
  </div>
</div>

<div class="is-flex"><div id="email-dec" style="margin: 0 auto; margin-bottom: 10px; color: green"></div></div>

<div class="buttons is-centered">
<button id="email-update" class="button is-info is-outlined">Güncelle</button>
</div>



    </div>
    <div class="is-hidden" id="password-tab-content">
    <div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Eski Şifre</label>
  </div>
  <div class="field-body">
    <div class="field">
      <p class="control">
        <input id="oldpassword" class="input is-rounded" type="password" placeholder="">
      </p>
    </div>
  </div>
</div>

<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Yeni Şifre</label>
  </div>
  <div class="field-body">
    <div class="field">
      <p class="control">
        <input id="password" class="input is-rounded" type="password" placeholder="">
      </p>
    </div>
  </div>
</div>

<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Yeni Şifre</label>
  </div>
  <div class="field-body">
    <div class="field">
      <p class="control">
        <input id="password2" class="input is-rounded" type="password" placeholder="">
      </p>
    </div>
  </div>
</div>

<div class="is-flex"><div id="password-dec" style="margin: 0 auto; margin-bottom: 10px; color: green"></div></div>

<div class="buttons is-centered">
<button id="password-update" class="button is-info is-outlined">Güncelle</button>
</div>
    </div>
    <div class="is-hidden has-text-centered" id="notifications-tab-content">
    <label class="checkbox">
  <input type="checkbox">
  Bildirimleri onaylıyorum.
</label>
    </div>
  </div>



  



    



</div>

</div>
<script>

$("#email-dec").hide();

$("#email-update").on('click', (event) => {
    var email=$("#email").val();
$.ajax({
    url: "update_email.php",
    type: "POST",
    data: {
        'email': email
    },
    success: function (result) {
        if (result == "Empty area") {
          $("#email-dec").show();
          $("#email-dec").html("Lütfen boş alan bırakmayınız.");
          $("#email-dec").css("color","red");

        } else if (result == "Success") {

            $("#email-dec").show();
          $("#email-dec").html("E-posta adresiniz başarıyla değiştirildi.");
          $("#email-dec").css("color","green");

        } else if (result == "Error") {

            $("#email-dec").show();
          $("#email-dec").html("Bir hata oluştu.");
          $("#email-dec").css("color","red");

        } else {

            $("#email-dec").show();
          $("#email-dec").html(result);
          $("#email-dec").css("color","red");
        }


        
    }
});
});









$("#password-update").on('click', (event) => {
    if($("#password").val()==$("#password2").val())
    {
    var oldpassword=$("#oldpassword").val();
    var password=$("#password").val();
$.ajax({
    url: "update_password.php",
    type: "POST",
    data: {
        'oldpassword': oldpassword,
        'password': password
    },
    success: function (result) {
        if (result == "Empty area") {
          $("#password-dec").show();
          $("#password-dec").html("Lütfen boş alan bırakmayınız.");
          $("#password-dec").css("color","red");

        } else if (result == "Success") {

            $("#password-dec").show();
          $("#password-dec").html("Şifreniz başarıyla değiştirildi.");
          $("#password-dec").css("color","green");

        } else if (result == "Error") {

            $("#password-dec").show();
          $("#password-dec").html("Bir hata oluştu.");
          $("#password-dec").css("color","red");

        }else if(result == "Wrong Password")
        {
            $("#password-dec").show();
          $("#password-dec").html("Şifre yanlış girildi.");
          $("#password-dec").css("color","red");
        }
        else {

            $("#email-dec").show();
          $("#email-dec").html(result);
          $("#email-dec").css("color","red");
        }


        
    }
});
    }
    else
    {
        $("#password-dec").show();
          $("#password-dec").html("Parolalar uyuşmuyor.");
          $("#password-dec").css("color","red");
    }
});
























$('.navbar-burger').click(function() {
  $('#navbarMenuHeroA, .navbar-burger').toggleClass('is-active');
});



function switchToAll() {
      removeActive();
      hideAll();
      $("#all-tab").addClass("is-active");
      $("#all-tab-content").removeClass("is-hidden");
    }

    function switchToPassword() {
      removeActive();
      hideAll();
      $("#password-tab").addClass("is-active");
      $("#password-tab-content").removeClass("is-hidden");
    }

    function switchToNotifications() {
      removeActive();
      hideAll();
      $("#notifications-tab").addClass("is-active");
      $("#notifications-tab-content").removeClass("is-hidden");
    }

    

    function removeActive() {
      $("li").each(function() {
        $(this).removeClass("is-active");
      });
    }

    function hideAll(){
      $("#all-tab-content").addClass("is-hidden");
      $("#password-tab-content").addClass("is-hidden");
      $("#notifications-tab-content").addClass("is-hidden");
    }




</script>
</body>

</html>