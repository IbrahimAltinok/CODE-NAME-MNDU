<?php require("database/users.php");?>
<?php require("css/index.css");?>
<?php require("css/user.css");?>

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

    <style media="screen">
      .survey_creation{
        width: 99%;
        margin-top: 2%;
        float: left;
        border-style: dashed;
        border-color: red;
        height: 50px;


      }
      .survey_creation_option{
        width: 89%;
        margin-top: 2%;
        float: left;
        border-style: dashed;
        border-color: red;
        height: 50px;


      }
      .user_surveyBuilderContent{
        width: 100%;
        margin-top: 2%;
        float: left;
        border-style: dashed;

      }

      .previewWindow{
        width: 100%;
        float: right;
        margin-top: 2%;
        border-style: dashed;
        text-align: left;
        margin-bottom: 5%;

      }
    </style>

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
          <div class="profil_oSurveys"> <a href="user.php"> <button id="profil_Surveys" name="submit" type="profil_oSurveys" class=" profil_optionButton"
            type="button" name="button"> <strong> Profil </strong> </button></a></div> <!-- Kullanıcının yayınladığı anketler -->
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
    <!-- Create content based on button : : butona göre içeriğin oluştupu  -->
    <div style="width:70%; margin-left:13%;" id="BuilderWindow"> <div class="formWindow">
    <form id="myForm" action="builder_save_survey.php" class="user_surveyBuilderContent" method="post">
      <input class="survey_creation" type="text" name="create_title" placeholder="başlık" ><br>
      <input class="survey_creation" type="text" name="create_image" placeholder="resim linki"><br>
      <input class="survey_creation" type="text" name="create_explanation" placeholder="açıklama & soru"><br>
      <input class="survey_creation" type="text" name="create_label" placeholder="#example, #example"><br>
      <input class="survey_creation_option" type="text" name="create_option" placeholder="seçenek">
      <input type="submit"  style="width:10%; float:right;" class="survey_creation" value="seçenek ekle"><br>
      <input type="submit"  style="width:30%; float:right;" class="survey_creation" value="Yayınla">

    </form>
    </div>
    <button style="width:30%; float:right;" class="survey_creation" onclick="myFunction()"> <strong>Ön İzleme</strong> </button>

    <div class="previewWindow">
    <div id="demo">

      <h1  id="enter_title"></h1>
      <img id="myImg" src="compman.gif" width="300" height="300">

      <p  id="enter_exp"></p>
      <p  id="enter_label"></p>
      <p  id="enter_option"></p>

    </div>
    </div>
    </div>


    <script>
    function myFunction() {
    var x = document.getElementById("myForm");
    var title = "";
    var img = "";
    var exp = "";
    var label = "";
    var opt = "";
    var i;
    title = title + x.elements[0].value;
    img = img + x.elements[1].value;
    exp = exp + x.elements[2].value;
    label = label + x.elements[3].value;
    opt = opt + x.elements[4].value;



    document.getElementById("myImg").src = img;

    document.getElementById("enter_title").innerHTML = title;
    document.getElementById("enter_exp").innerHTML = exp;
    document.getElementById("enter_label").innerHTML = label;
    document.getElementById("enter_option").innerHTML = opt;

    }
    </script>









  </body>
</html>
