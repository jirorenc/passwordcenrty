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
    <script src="../js/category_select_entegrasyon.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript">
        var user_name = '<?php echo $_SESSION["kullanici_adi"]; ?>';
        if (user_name == "" || user_name == null) {
            window.location.href = "login_page.php";
        }
    </script>
    <!-- this script For user's put table -->
    <script type="text/javascript">
        var id = 0;
        var kategori_list;
        var tablo_control = "";
        var text = "";
        var i = x = "";
        var request = new XMLHttpRequest();
        var url = "http://localhost/clone-passwordcentry/api/kategori_post/kategori_read.php";
        id = '<?php echo $_SESSION["id"]; ?>';
        try {
            request.open('POST', url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function () {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        text = request.responseText.toString();
                        tablo_control = JSON.parse(text);
                        if (tablo_control.message != 0) {
                            tablo_load(text);
                        }
                    }
                }
            };
        } catch (err) {
            document.getElementById("demo").innerHTML = err.message;
        }
        request.send("uyeler_fk=" + id);
    </script>
    <!-- this script For category create-->
    <script>
        function kategori_ekle(frm) {
            var kadi = frm.u_name.value;
            var ka_adi = frm.k_name.value;
            var sifre1 = frm.password.value;
            var soap = frm.soap.checked;
            var rest = frm.rest.checked;
            var xml = frm.xml.checked;
            var json = frm.json.checked;
            var id = 0;
            var data = $("#login-form").serialize();
            var request = new XMLHttpRequest();
            var url = "http://localhost/clone-passwordcentry/api/kategori_post/kategory_create.php";
            id=  '<?php echo $_SESSION["id"]; ?>';
            if (ka_adi == null || ka_adi === "" || ka_adi.length < 3) {
                alert("Kategori adı 3 karakterden az olamaz");
                return false;
            }
            if (kadi == null || kadi === "" || kadi.length < 3) {
                alert("Kullanıcı adı 3 karakterden az olamaz");
                return false;
            }
            if (sifre1 == null || sifre1 === "") {
                alert("Şifreyi boş bırakmayın");
                return false;
            }
            if (!soap && !rest && !xml && !json) {
                alert("En az bir tane api seçmelisiniz");
                return false;
            }
            else {
                try {
                    request.open('POST', url, true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.onreadystatechange = function () {
                        if (request.readyState === XMLHttpRequest.DONE) {
                            if (request.status === 200) {
                                var text = request.responseText.toString();
                                var obj = JSON.parse(text);
                                var res = obj.message;
                                if (res != '0') {
                                    alert("Başarı ile kategori oluşturuldu")
                                    location.reload();
                                } else {
                                    alert("Bu kategori adı mevcut veya bir hata oluştu!")
                                }
                            }
                        }
                    };
                } catch (err) {
                    document.getElementById("demo").innerHTML = err.message;
                }
                request.send(data + "&id=" + id);
            }
            return false;
        }
    </script>
</head>
<body>
<!--this div  usrer's info for put in session -->
<div class="container">

    <div class="card" style="background: yellowgreen; text-align: center">
        <div class="row padding">
            <div class="col-lg-3" style="padding: 6px;border-radius: 6px; ">
                <?php
                echo "Hoş gelidiniz sayın: " . $_SESSION["kullanici_adi"];
                ?>
            </div>
            <div class="col-lg-3" style=" padding: 6px;border-radius: 6px; ">
                <?php
                echo "firma adı :" . $_SESSION["firma"];
                ?>
            </div>
            <div class="col-lg-3" style=" padding: 6px;border-radius: 6px; ">
                <?php
                echo "e-posta: " . $_SESSION["email"];
                ?>
            </div>
            <div class="col-lg-3" style=" padding: 6px;border-radius: 6px; ">
                <button type="button" name="exit" id="exiti" onclick="exit()" class="btn btn-success">Çıkış yap</button>
            </div>

        </div>
    </div>
</div>

<div class="container padding" style="margin-top: 300px">

</div>
<p id="tab"></p>
<!-- FOR MODAL CREATE CATEGORY-->
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
                                    Kategori Adı: <input type="text" name="k_name" id="k_name"><br>
                                    Kullanici Adı: <input type="text" name="u_name" id="u_name"><br>
                                    Şifre: <input type="password" name="password" id="password"><br>
                                    Api:
                                    <label class="radio-inline"><input type="checkbox" name="soap" value="1" checked>Soap</label>
                                    <label class="radio-inline"><input type="checkbox" name="rest"
                                                                       value="2">Rest</label>
                                    <label class="radio-inline"><input type="checkbox" name="xml"
                                                                       value="3">Xml-Rpc</label>
                                    <label class="radio-inline"><input type="checkbox" name="json"
                                                                       value="4">Json-Rpc</label>
                                    <input type="submit" name="k_ekle" class="btn btn-success btn-block" id="k_ekle"
                                           onsubmit="return kategori_ekle(this)" value="Oluştur">
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

<p id="tab"></p>
<!-- FOR MODAL CREATE MEMBER-->
<div class="container">


    <div class="modal fade" id="add_member_Modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Üye Oluştur</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <form method="post" id="uye-form" onsubmit="return gonder(this)">
                        <div class="row" style="position: relative">
                            <div class="col-lg-12">
                                <div class="card jumbotron" style="padding: 20px">
                                    Üye Adı: <input type="text" name="uye_name" id="uye_name"><br>
                                    E-mail: <input type="email" name="uye_email" id="uye_email"><br>
                                    Şifre: <input type="password" name="uye_password" id="uye_password"><br>
                                    Başlangıç tarihi:<input  class="form-control" type="datetime-local" name="datetime_begin" value="2018-07-19T13:45:00" id="datetime_begin"><br>
                                    Bitiş Tarihi:<input class="form-control" type="datetime-local" name="datetime_finish" value="2018-07-19T13:45:00" id="datetime_finish"><br>
                                    <input type="submit" name="uye_ekle" class="btn btn-success btn-block" id="uye_ekle"
                                           onsubmit="return  gonder(this)" value="Oluştur">
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
<!--this div show to category-->
<div class="container">
    <h2>Kategori Tablosu</h2>
    <button type="button"
            data-toggle="modal" data-target="#myModal"
            class="btn pull-right btn-success">Kategori Ekle
    </button>
    <p>Oluşturduğunuz kategorileri burdan kontrol edebilirsiniz:</p>


    <table class="table table-striped">
        <thead>
        <tr>
            <th>Kategori Adı</th>
            <th>Kullanıcı Adı</th>
            <th>Düzenle</th>
            <th>Durum</th>
            <th>Üye Ekle</th>
        </tr>
        </thead>
        <tbody id="kard">

        </tbody>
    </table>
</div>
<script type="text/javascript">
    var tablo_extra="";
    function tablo_load(tablo) {

        tablo_extra=tablo;
        tablo_extra= JSON.parse(tablo_extra);
        tablo_extra = tablo_extra.data;
        var i=0;
        var txt = "";
        for (i = 0; i < tablo_extra.length; i++) {
            txt += "<tr><td >" + tablo_extra[i].kategori_adi + "</td>" +
                "<td>" + tablo_extra[i].kullanici_adi + "</td>" +
                "<td><input  class='btn btn-primary'  type='button' value='Düzenle'>" + "</td>" +
                "<td><input id='buttuns" +i+ "' class='btn tablo_button' onchange='alrt("+i+"," + tablo_extra[i].aktif + ")' onclick='durum_degistir("+i+","+ tablo_extra[i].id + "," + tablo_extra[i].aktif + ")'   type='button'>"
                + "</td>" +
                "<td><button id='uye_ekle"+i+"' class='btn btn-success add_button'  data-id='"+ tablo_extra[i].id + "' data-toggle='modal' data-target='#add_member_Modal'   type='button' ><i class='fa fa-plus-square-o'></i>" + "</td>" +
                "</tr>";
        }
        clik_button();
        document.getElementById("kard").innerHTML = txt;
    }
</script>
<div class="container-fluid" style="margin-top: 1000px">

</div>
<script type="text/javascript">
    function clik_button() {
        $(document).ready(function () {
            $('.tablo_button').change();
        })
    }
    function alrt(i, durum) {
        var inputval = document.getElementById("buttuns" + i);
        if (durum == 1) {
            inputval.style.backgroundColor = "#77e241";
            inputval.value = "Aktif";
        } else {
            inputval.style.backgroundColor = "#FFD700";
            inputval.value = "Pasif";
        }
    }
    function durum_degistir(i,id,durum) {
        if(durum==0){
            durum=1;
            var request= new change_state(id,durum);
            alrt(i,durum);
            location.reload();
        }
        else{
            durum=0;
            var request= new change_state(id,durum);
            alrt(i,durum);
            location.reload();
        }
    }
</script>
<script>
    var send_kategori_Id="";
    $(document).on("click", ".add_button", function () {
        send_kategori_Id= $(this).data('id');
    });
    function gonder(uye) {
       var sonuc= new uye_ekle(uye,send_kategori_Id);
        location.reload();
    }
</script>
<script>
    console.log("çalışıyor");
</script>
<script type="text/javascript">

        var t=new Date();
        var inputval = document.getElementById("datetime_begin");
        var inputval2 = document.getElementById("datetime_finish");
        var tarih=t.toLocaleDateString();
        console.log(t);
        var tarih=tarih.slice(6,10)+"-"+tarih.slice(3,5)+"-"+tarih.slice(0,2);
        inputval.value=tarih+"T"+(t.toLocaleTimeString()).slice(0,5);
        inputval2.value=tarih+"T"+(t.toLocaleTimeString()).slice(0,5);

</script>
<script type="text/javascript">
    function exit() {
        jQuery('#exiti').load('../session.php?kullanici_adi=' + "");
        jQuery('#name').load('../session.php?id=' + "");
        window.location.href = "login_page.php";
    }
</script>
</body>
</html>