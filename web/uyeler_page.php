<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <script type="text/javascript">
        var user_name= '<?php echo $_SESSION["kullanici_adi"]; ?>';
        if(user_name=="" || user_name==null){
            window.location.href="login_page.php";
        }
    </script>
    <script>
        function kategori_ekle(frm) {
            var kadi = frm.u_name.value;
            var ka_adi = frm.k_name.value;
            var sifre1 = frm.password.value;
            var id=0;
            var data = $("#login-form").serialize();
            var request = new XMLHttpRequest();
            var url = "http://localhost/clone-passwordcentry/api/post/kategory_create.php" ;
            id=  '<?php echo $_SESSION["id"]; ?>';
            if ( ka_adi==null || ka_adi==="" || ka_adi.length < 3 )
            {
                alert("Kategori adı 3 karakterden az olamaz");
                return false;
            }
            if ( kadi==null || kadi==="" || kadi.length < 3 )
            {
                alert("Kullanıcı adı 3 karakterden az olamaz");
                return false;
            }

            if ( sifre1 == null || sifre1 === "" )
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
                            var  text=request.responseText.toString();
                           var obj = JSON.parse(text);
                            var res = obj.message;
                            console.log(text);
                            if (res!='0') {
                                alert("Başarı ile kategori oluşturuldu")
                            }else{
                                alert("Bu kategori adı mevcut!")
                            }
                        }
                    }
                };
                request.send(data+"&id="+id);
            }
            return false;
        }
    </script>
</head>
<body>
<div class="container">

    <div class="card" style="background: yellowgreen; text-align: center">
        <div class="row padding">
            <div class="col-lg-3" style="padding: 6px;border-radius: 6px; ">
                <?php
                echo "Hoş gelidiniz sayın: " . $_SESSION["kullanici_adi"] ;
                ?>
            </div>
            <div class="col-lg-3" style=" padding: 6px;border-radius: 6px; ">
                <?php
                echo "firma adı :" . $_SESSION["firma"] ;
                ?>
            </div>
            <div class="col-lg-3" style=" padding: 6px;border-radius: 6px; ">
                <?php
                echo "e-posta: " . $_SESSION["email"] ;
                ?>
            </div>
            <div class="col-lg-3" style=" padding: 6px;border-radius: 6px; ">
                <button type="button"  name="exit" id="exiti" onclick="exit()" class="btn btn-success">Çıkış yap</button>
            </div>

        </div>
    </div>
</div>

<div class="container padding" style="margin-top: 300px">

</div>


<div class="container">


    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kategori Oluştur</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <form method="post" id="login-form" onsubmit="return kategori_ekle(this)">
                        <div class="row" style="position: relative">
                            <div class="col-lg-12">
                                <div class="card jumbotron" style="padding: 20px">
                                    Kategori_adi: <input type="text" name="k_name" id="k_name"><br>
                                    Kullanici_adi: <input type="text" name="u_name" id="u_name"><br>
                                    Şifre: <input type="password" name="password" id="password"><br>
                                    <label class="radio-inline"><input type="checkbox" name="optradio">Soap</label>
                                    <label class="radio-inline"><input type="checkbox" name="optradio">Rest</label>
                                    <label class="radio-inline"><input type="checkbox" name="optradio">Xml-Rpc</label>
                                    <label class="radio-inline"><input type="checkbox" name="optradio">Json-Rpc</label>
                                    <input type="submit" name="k_ekle" class="btn btn-success btn-block"  id="k_ekle" onsubmit="return kategori_ekle(this)" value="Oluştur">
                                </div>

                            </div>
                        </div>
                        <br>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="container">
    <h2>Kategoriler  <button type="button"
                             data-toggle="modal" data-target="#myModal"
                             class="btn pull-right btn-success">Kategori Ekle</button></h2>

    <table class="table table-bordered " style="text-align: center">
        <thead>
        <tr>
            <th>Kategori Adı</th>
            <th>Düzenle</th>
            <th>Aktif</th>
            <th>Pasif</th>
            <th>Üye Ekle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Ankara</td>
            <td>  <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn  btn-primary">Düzenle</button></td>
            <td> <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn  btn-success">Aktif</button</td>
            <td>  <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn  btn-secondary">Pasif</button></td>
            <td>  <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn  btn-primary">Üye Ekle</button></td>
        </tr>
        <tr>
            <td>ankararay</td>
            <td>  <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn btn-primary">Düzenle</button></td>
            <td>  <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn btn-secondary">Aktif</button></td>
            <td>  <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn btn-warning">Pasif</button></td>
            <td> <button type="button"  name="k_ekle" id="k_ekle" onclick="kategori_ekle()" class="btn btn-primary">Üye Ekle</button></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="container-fluid" style="margin-top: 1000px">

</div>
<div class="container">
    <button type="button"  name="exit" id="exiti" onclick="exit()" class="btn pull-right btn-success">Çıkış yap</button>
</div>







<script type="text/javascript">
    function exit(){
        jQuery('#exiti').load('../session.php?kullanici_adi='+"" );
        jQuery('#name').load('../session.php?id='+"" );
        window.location.href="login_page.php";
    }
</script>
</body>
</html>