
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
    jQuery('#password').load('../session.php?kullanici_adi='+"" );
    jQuery('#name').load('../session.php?id='+"" );
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
            try{
           request.open('POST', url, true);
           request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           request.onreadystatechange = function() {
               if (request.readyState === XMLHttpRequest.DONE) {
                   if (request.status === 200) {
                       var text=request.responseText.toString();
                       console.log(text);
                       var obj = JSON.parse(text);
                       var res = obj.message;
                       var id  = obj.id;
                       var firma=obj.firma;
                       var eposta=obj.email;
                       if (res!=='0') {
                           jQuery('#name').load('../session.php?kullanici_adi='+ kadi+'&id='+id+'&firma='+firma+'&email='+eposta);
                          window.location.href="uyeler_page.php";
                       }else{
                           alert("Kullanıcı adı veya şifre yanlış!");
                       }
                   }else if(request.status===0){
                       alert("Bağlantı hatası lütfen internet bağlantınızı kontrol ediniz!!! internetiniz bağlı ise sunucu hatası bulunmaktadır!!")
                   }
               }
           }; }catch (e) {
            console.log("asd ");
        }
           request.send(data);
       }
        return false;
    }

</script>
<body>
<div class="container" style="position: center">
    <div class="jumbotron padding" style="margin: 200px;">
        <form method="post" id="login-form" onsubmit="return submitForm(this)">
            <div class="row" style="position: relative;">
                <div class="col-lg-12">
                    <div class="card jumbotron" style="padding: 20px">
                        Kullanıcı Adı: <input type="text" name="name" id="name"><br>
                        Şifre: <input type="password" name="passwordone" id="password"><br>
                        <input type="submit" name="uyeekle" class="btn btn-success btn-block" value="Giriş Yap">
                    </div>

                </div>
            </div>
            <div style="text-align: center">
                <label style="text-align: center"> <a href="home_bage.php"> Henüz üye değilimisiniz!</a></label>
            </div>
        </form>
    </div>

</div>


<script>

</script>
</body>
</html>
