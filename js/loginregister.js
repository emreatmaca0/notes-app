$(document).ready(function(){

    $("#great_area").on('click', '#register', function(){
        var name_rg=$("input[name=name_rg]").val();
        var email=$("input[name=email]").val();
        var password=$("input[name=password]").val();
        var passwordconfirm=$("input[name=passwordconfirm]").val();
        if (password==passwordconfirm) {


            $.ajax({
                url: "register_play.php",
                type: "POST",
                data: {
                    'name': name_rg,
                    'email': email,
                    'password': password
                },
                success: function (result) {
                    if (result == "Empty area") {
                        $("#warning").show();
                        $("#warning").html("Lütfen bilgilerinizi eksiksiz ve doğru giriniz.");

                    } else if (result == "Success") {

                        window.location.replace("login");
                        

                    } else if (result == "Error") {
                        $("#warning").show();
                        $("#warning").html("Bir hata oluştu. Lütfen daha sonra deneyiniz.");

                    } else {
                        $("#warning").show();
                        $("#warning").html(result);
                    }


                    
                }
            });
        }
        else
        {
            $("#warning").show();
            $("#warning").html("Parolalar uyuşmuyor.");
        }
    });

$("#good_area").on('click', '#login', function (){

        
        var email=$("input[name=email]").val();
        var password=$("input[name=password]").val();

        $.ajax({
            url: "login_play.php",
            type: "POST",
            data: {
                'email': email,
                'password': password
            },
            success: function (result) {
                if (result == "Empty area") {

                    $("#warning").show();
                    $("#warning").html("Lütfen boş alan bırakmayınız.");

                } else if (result == "Success") {

                    window.location.replace("notes");

                } else if (result == "Error") {

                    $("#warning").show();
                    $("#warning").html("E-posta veya şifre yanlış");

                } else {
                    
                    $("#warning").show();
                    $("#warning").html(result);
                }


                
            }
        });


    });

});