<?php require("database/users.php");?>
<?php require("css/index.css");?>
<?php require("css/user.css");?>
<?php require("phpFunctions/separateoptions.php");?>

<?php  session_start(); ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>USER INTERFACE</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Font Awesome 5 Icons -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  </head>

  <body>
    <!-- HEADER: :BAŞLIK -->
    <div class="index_header"> </div> <!-- başlığı çağır -->
    <!-- ******************************************************************** -->

    <!-- USER INFO - USER INTERFACE: :KULLANICI BİLGİLERİ - KULLANICI ARAYÜZÜ -->
    <div class="Profil_Content"> <!-- Kullanıcın İşlem yapacağı ve bilgilerinin yer alacağı kısım -->
      <div class="profil_InformationCard"> <!-- Kullanıcı Resmi Ve Adı -->
        <img class="profil_ICPicture" src="<?php echo $_SESSION['foto'] ; ?>" alt=""> <!-- Kullanıcı resmi -->
        <h3 class="profil_ICNickname"><?php  echo $_SESSION["nickname"]; ?></h3> <!-- Kullanıcı adı-->
      </div>
      <!-- options : : seçenekler  -->
        <div class="profil_options"> <!-- Kullanıcının yapabileceği işlemler -->
          <div class="profil_oSurveys"> <button id="profil_Surveys" name="submit" type="profil_oSurveys" class=" profil_optionButton"
            type="button" name="button"> <strong> Anketlerim </strong> </button></div> <!-- Kullanıcının yayınladığı anketler -->
          <div class="profil_oSaved">  <button id="profil_Saved" onclick="profil_oSaved()" class="  profil_optionButton"
            type="button" name="button"> <strong> Oylananlar  </strong> </button></div>  <!-- Kullanıcının katıldığı anketler -->
          <div class="profil_oSurveyBuilder"> <a href="builder.php"><button id="profil_SurveyBuilder" class=" profil_optionButton"
            type="button" name="button"> <strong>  Anket Oluştur </strong> </button></a></div>  <!-- anket oluştur -->
          <div class="profil_oSettings">  <button id="profil_Settings" class=" profil_optionButton"
            type="button" name="button"> <strong> Ayarlar </strong> </button></div>  <!-- ayarlar -->
        </div>
    </div>
    <!-- ******************************************************************** -->
    <!-- Selected Content : : Seçilen İçerik-->
    <div class="User_SelectedContent" class="User_SelectedContent">

      <?php

        try {
              // veritabanındna istenen verileri çek
              $stmt = $conn->prepare("SELECT id, userID, title, label, imageLink,
                explanation, likeNo, voteNo, options, optionsVote FROM usersurvey");
              $stmt->execute();

              // set the resulting array to associative : : veri tabanı için array oluştur
              $id_=array(); $title_=array(); $userID_=array(); $label_=array();
              $imageLink_=array(); $explanation_=array(); $likeNo_=array();
              $voteNo_=array(); $options_=array(); $optionsVote_=array();

              // veritabanındaki değerleri array içine at
              foreach($stmt as $k=>$v)
                {
                  if ($v["userID"] == $_SESSION["id"])
                    {
                      array_push($title_, $v["title"]);
                      array_push($id_, $v["id"]);
                      array_push($userID_, $v["userID"]);
                      array_push($label_, $v["label"]);
                      array_push($imageLink_, $v["imageLink"]);
                      array_push($explanation_, $v["explanation"]);
                      array_push($likeNo_, $v["likeNo"]);
                      array_push($voteNo_, $v["voteNo"]);
                      array_push($options_, $v["options"]);
                      array_push($optionsVote_, $v["optionsVote"]);
                    }
                }
            }
        catch(PDOException $e)
            {
              echo "Error: " . $e->getMessage();
            }
             $conn = null;?>
      <!-- Create content based on button : : butona göre içeriğin oluştupu  -->
      <div id="SelectedContent"> </div>
    </div>

        <script>
        /* 4 farklı butona basıldıktan sonra olacaklar
          Buton-1: Anketlerim
          Buton-2: Oy verilenler
          Buton-3: Anket Oluşturma
          Buton-4: Ayarlar
        */
        /* Buton-1: Anketlerim  : : My Surveys */
          $(document).ready(function(){
            $("#profil_Surveys").click(function(){
              $("#SelectedContent").html("<?php
               $arrayUserSurveys = count($title_);
               $sayı= $arrayUserSurveys-1;
               for ($x = $sayı; $x >= 0; $x--)
                 { //style='overflow-y: auto;'
                   echo "<div class='userSurveysAll'   >".
                   "<img class='btn_card_image' src='$imageLink_[$x]'></img>".
                   "<div class='userSurveyInfo'>".
                   "<h1 style='text-align:left; align:left;' id='info_card'>".$title_[$x]."</h1>".
                   "<p style='text-align:left; width:100%;' class='info_card_label'>".$label_[$x]."</p>".
                   "<p style='width: 20%; float:left; text-align:left;'class='info_card_left'><i class='fa fa-heart' style='font-size:24px'> ".$likeNo_[$x]."</i></p>".
                   "<p style='width: 20%; float:left; text-align:left; ' class='info_card_right'><i class='fas fa-paw' style='font-size:24px'> ".$voteNo_[$x]."</i></p>".
                   "<p style=' width:100%; height:70px; text-align:left; overflow-y: auto;' class='info_card_explanation'>".$explanation_[$x]."</p>";


                     echo "</div>";
                     echo "<div style='margin-left:35%; width:65%; overflow-y: auto; height:125px;'>";

                   $options = array();
                   $options=explode(",",$options_[$x]);
                   $optionsVote=explode(",",$optionsVote_[$x]);
                   $sumOFVote= array_sum($optionsVote);
                   $votePercentageArray = array();

                   foreach ($optionsVote as $key => $value) {
                     $percentageValue= $value*100/$sumOFVote;
                     array_push($votePercentageArray,$percentageValue);
                   }

                   foreach ($options as $key => $value) {
                     echo "<p style='  text-align:left; ' ><strong>".
                    $value. "</strong> %".number_format($votePercentageArray[$key],2).
                     " (".$optionsVote[$key]." kişi)</p>";
                   }
                   echo "</div>";
                  echo "</div>";
                }

                   ?>");
            });

            /* Buton-2: Oy verilenler : : Voted Surveys   */

            $("#profil_Saved").click(function(){
              $("#SelectedContent").html("<?php
                for ($x = 10; $x >= 0; $x--) {
                    echo "<button class='btn1'>$x</button><br>";}
            ?>");
            });
            /* Buton-3: Anket Oluşturma : : Survey Builder   */
            $("#profil_SurveyBuilder").click(function(){
              $("#SelectedContent").html("<?php
              header("location:builder.php");

               ?>");


            });



            /* Buton-4: Ayarlar : : Settings   */
            $("#profil_Settings").click(function(){
              $("#SelectedContent").html("<?php
              echo "<div style='height:400px; background-colour: ;'><button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Kullanıcı Adını Değiştir</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Profil Fotoğrafını Değiştir</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Şifreni Güncelle</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Kullanıcı Adını Değiştir</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Email Bilgileri</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Giriş Hareketleri</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>Çıkış Yap</button>".
              "<button style=' width:50%; height:30px; margin-top:10px; margin-left:3%;'>İptal</button></div>";


               ?>");
            });
          });
      </script>








  </body>
</html>
