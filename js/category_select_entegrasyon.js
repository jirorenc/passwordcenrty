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
function uye_ekle () {

}