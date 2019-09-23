
<script>
/*  Kullanıcı form bilgilerini girmezse verilecek pencere  */
/*  Eksik bir bilgi girilirse */
function userFormEmtyCheckBox()
{
  var x = document.forms["userFormName"]["nickname_login"].value;
  var y = document.forms["userFormName"]["password_login"].value;

    if (x == "" && y == "") {
      alert("Kullanıcı bilgilerini doldurmadınız");
      return false;
    }
    else if (x == "") {
      alert("Kullanıcı adını girmediniz");
      return false;
    }
    else if (y == "") {
      alert("Parolanızı girmediniz");
      return false;
    }
}
/*  Eksik bir bilgi girilirse */
function checkNickNamePassword()
{
    alert("Bilgilerinizi kontrol ediniz");
}
</script>
