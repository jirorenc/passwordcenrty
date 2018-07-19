var change_state= function (ka_id,durum){

    var request = new XMLHttpRequest();
    var url = "http://localhost/clone-passwordcentry/api/kategori_post/kategori_update.php";
    try {
        request.open('POST', url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    text = request.responseText.toString();
                    return text;
                }
            }
        };
    } catch (err) {
        document.getElementById("demo").innerHTML = err.message;
    }
    request.send("id=" + ka_id+"&aktif="+durum);

};

var uye_ekle= function(uye,ka_id){
    var u_adi = uye.uye_name.value;
    var email = uye.uye_email.value;
    var sifre1 = uye.uye_password.value;
    var data = $(uye).serialize();
    var request = new XMLHttpRequest();
    var url = "http://localhost/clone-passwordcentry/api/kategori_post/kategori_uye_ekle.php";
    if (u_adi == null || u_adi === "" || u_adi.length < 3) {
        alert("Kullanıcı adı 3 karakterden az olamaz!!!");
        return false;
    }
    if (email == null || email === "" || email.length < 3) {
        alert("Doğru mail adresi giriniz!!!");
        return false;
    }
    if (sifre1 == null || sifre1 === "") {
        alert("Şifreyi boş bırakmayın!!");
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
                        var res=JSON.parse(text);
                        res=res.message;
                        if(res!=0){
                            alert("Başarı ile kategori oluşturuldu");
                        }else {
                            alert("bir sorun oluştu");
                        }

                    }
                }
            };
        } catch (err) {
            document.getElementById("demo").innerHTML = err.message;
        }
        request.send(data + "&ka_id=" + ka_id);
    }
};
