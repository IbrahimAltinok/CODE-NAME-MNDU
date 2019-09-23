<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title> DATABASE - check user entrance </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

  <?php
  // veritabanı bağlantısını aç
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $myDB ="Surveys";

  try {
        $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
  catch(PDOException $e)  // veritabanı bağlantı hatasını ekrana bas
      {
  ?>   <div class="alert alert-danger" >
        <strong>Veri Tabanına Grişi Hatası</strong>  <?php echo " <br>";
        echo $e->getMessage(); ?><br>
       </div>
  <?php
      }
  ?>




</body>
</html>
