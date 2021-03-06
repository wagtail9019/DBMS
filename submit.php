<?php
  session_start();
  $name=$_SESSION["name"];
  $email=$_SESSION["email"];
  $message=$_SESSION["message"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>アンケート（回答完了）</title>
</head>

<body>
  <?php
    $dbcon=new dbmanager;
    $dbcon->dbconnect("guestbook", "root");
    $dbcon->dbinsert();
    echo "回答完了";
?>
</body>

</html>

<?php
  class dbmanager
  {
      public function dbconnect($dbname, $dbuser)
      {
          try {
              $pdo=new PDO("mysql:dbname=$dbname;dbhost=localhost;charset=utf8mb4", "$dbuser", "");
          } catch (PDOException $e) {
              echo "データベース接続エラー";
          }
      }
      public function dbinsert()
      {
          $sql="insert into test values(:name,:email,:message);";
          $stmt=$pdo->prepare($sql);
          $stmt->bindParam(":name", $name, PDO::PARAM_STR);
          $stmt->bindParam(":email", $email, PDO::PARAM_STR);
          $stmt->bindParam(":message", $message, PDO::PARAM_STR);
          $stmt->execute();
      }
  }
