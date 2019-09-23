<?php require("database/users.php");?>
<?php require("css/index.css");?>
<?php require("JavaScript/index.js"); ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ANASAYFA / HOMEPAGE</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  </head>

  <body>
    <div class="index_header">
    <?php
      session_start(); // session başlatıldı
 	    if(isset($_POST['submit_login'])) // userLoginForm formundan gelen postu yakala
 			{
   			 $nickname = $_POST["nickname_login"]; // kullanıcı adını formdan al
   			 $user_password = $_POST["password_login"]; // kullanıcı parolasını formdan al

         if($nickname && $user_password) // kullanıcı adı yada paroladan biri girilmezse
   				 {
             // veritabanından parola ve kullanıcı adını al
             $query = $conn->prepare("select * from people where nickname = ? and password = ?");
             $query->execute([$nickname, $user_password]);
             $row = $query->fetch(PDO::FETCH_ASSOC);
             $ok = $query->rowcount();

            if($ok) // kullanıcı adı ve parola değeri 1 dönerse session içine al
              {
                $_SESSION["nickname"] = $row["nickname"];
                $_SESSION["foto"] = $row["picture"];
                $_SESSION["id"] = $row["id"];
                header("location:index.php");
              }

            else
              {
                echo '<script type="text/javascript"> checkNickNamePassword(); </script>';
              }
   				 }
 		   }

		  if($_SESSION) // session kurulursa giriş sonrasını yaz
          { ?>
            <div class="userLogOut">
              <a href="user.php">
                <img class="profil_image" src="<?php echo $_SESSION["foto"]; ?>" alt="">
              </a>
            <?php echo "<a class='userLogOut_a' href='userExit.php' onsubmit='postUserInfo()' >Çıkış</a>";?></p></div>

<?php     }

      else // session ile giriş olmaz ise basılacak değeri yaz
         {?>
              <form name="userFormName" class="userLoginForm" onsubmit="return userFormEmtyCheckBox()" method="post">
                <input type="text" name="nickname_login" placeholder="Kullanıcı-Adı" />
                <input type="text" name="password_login" placeholder="Paralo" />
                  <button type="submit" name="submit_login">Giriş</button>
              </form>
      <?php	} ?>
    </div>

  </body>
</html>
