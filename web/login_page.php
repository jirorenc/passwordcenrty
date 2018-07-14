
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
</head>
<script type="text/javascript">

    function submitForm(frm) {
        var kadi = frm.name.value;
        var sifre1 = frm.passwordone.value;
        var data = $("#login-form").serialize();
        var request = new XMLHttpRequest();
        var url = "http://localhost/clone-passwordcentry/api/post/login_control.php";
        if ( kadi==null || kadi=="" || kadi.length < 3 )
        {
            alert("Kullanıcı adı 3 karakterden az olamaz");
            return false;
        }
       if ( sifre1 == null || sifre1 == "" )
        {
            alert("Şifreyi boş bırakmayın");
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
                           jQuery('#name').load('../utils/session.php?kullanici_adi='+ kadi );
                           window.location.href="uyeler_page.php";
                       }else{
                           alert("Kullanıcı adı veya şifre yanlış!")
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
<div class="container" style="position: center">
    <div class="jumbotron padding" style="margin: 200px;">
        <form method="post" id="login-form" onsubmit="return submitForm(this)">
            <div class="row" style="position: relative">
                <div class="col-lg-12">
                    <div class="card jumbotron" style="padding: 20px">
                        Kullanıcı Adı: <input type="text" name="name" id="name"><br>
                        Şifre: <input type="password" name="passwordone" id="password"><br>
                        <input type="submit" name="uyeekle" class="btn btn-success btn-block" value="Giriş Yap">
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
