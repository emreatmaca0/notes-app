<?php

session_start();

if(isset($_SESSION['name'])){
   header('location: notes');
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notew | Kayıt Ol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/inputs.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/loginregister.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body>

<div class="background is-flex is-justify-content-center is-flex-wrap-wrap is-align-items-center">

    <div class="box area is-flex is-flex-direction-column is-justify-content-center is-flex-wrap-wrap is-align-items-center" id="great_area">

    <img src="images/Notew.png">

        <div class="form__group fieldi">
            <input type="text" class="form__field" placeholder="İsim" name="name_rg" id='name_id' required />
            <label for="name" class="form__label">İsim</label>
        </div>

        <div class="form__group fieldi">
            <input type="email" class="form__field" placeholder="E-posta" name="email" id='email_id' required />
            <label for="email" class="form__label">E-posta</label>
        </div>

        <div class="form__group fieldi">
            <input type="password" class="form__field" placeholder="Parola" name="password" id='password_id' required />
            <label for="password" class="form__label">Parola</label>
        </div>

        <div class="form__group fieldi">
            <input type="password" class="form__field" placeholder="Parola" name="passwordconfirm" id='passwordconfirm' required />
            <label for="password" class="form__label">Parola</label>
        </div>

        <p style="margin-top: 50px; color: red; display: none;" id="warning"></p>

        <button id="register" class="button is-success e-button">
                <span class="material-symbols-outlined">how_to_reg</span> Kayıt Ol
            </button>



        <a href="login" class="e-button" style="color: royalblue; text-decoration: underline;">ya da Giriş Yap</a>



    </div>

</div>




</body>

</html>
