<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous">
    </script>
</head>
<script type="text/javascript">

    function submitForm(frm) {
        var kadi = frm.name.value;
        var sifre1 = frm.passwordone.value;
        var sifre2 = frm.passwordtwo.value;
        var email = frm.email.value;
        var atpos=email.indexOf("@");
        var dotpos=email.lastIndexOf(".");
        var data = $("#login-form").serialize();
        var request = new XMLHttpRequest();
        var url = "http://localhost/php_rest_myblog/api/post/create.php";
        var usernameWarning = document.getElementById('usernameResult');
        if ( kadi==null || kadi=="" || kadi.length < 3 )
        {
            alert("Kullanıcı adı 3 karakterden az olamaz");
            return false;
        }
        else if ( sifre1 == null || sifre1 == "" || sifre2 == null || sifre2 == "")
        {
            alert("Şifreyi boş bırakmayın");
            return false;
        }
        else if ( !(sifre1 == sifre2) )
        {
            alert("Şifreler eşleşmiyor");
            return false;
        }
        else if ( atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length )
        {
            alert("Geçerli email adresi girin");
            return false;
        }
        else{
                request.open('POST', url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function() {
                    if (request.readyState === XMLHttpRequest.DONE) {
                        if (request.status === 200) {
                            var text=request.responseText.toString();
                            var obj = JSON.parse(text);
                            var res = obj.message;
                            if (res!=='0') {
                                usernameWarning.innerHTML = "The username you typed has been used!";
                                window.location.href="login_page.html";
                            }else{
                               alert("Bu kullanıcı adı kullanılmakta!")
                            }
                        }
                    }
                };
                request.send(data);
        }

        return false;
    }

</script>
<body>
<p id="usernameResult"></p>
<div class="container" style="position: center">
    <div class="jumbotron padding" style="margin: 200px;">
        <form method="post" id="login-form" onsubmit="return submitForm(this)">
            <div class="row" style="position: relative">
                <div class="col-lg-12">
                    <div class="card jumbotron" style="padding: 20px">
                        Kullanıcı Adı: <input type="text" name="name" id="name"><br>
                        Şifre: <input type="password" name="passwordone" id="password"><br>
                        Şİfre Tekrar: <input type="password" name="passwordtwo" id="passwordtwo"><br>
                        Firma Adı: <input type="text" name="firma_adi" id="firma_adi"><br>
                        E-mail: <input type="email" name="email" id="email"><br>
                        <input type="submit" id="login_button" name="uyeekle" class="btn btn-success btn-block" value="Kaydı Tamamla">
                        <span class="glyphicon glyphicon-transfer"></span>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>

</div>


<script>

</script>
</body>
</html>
