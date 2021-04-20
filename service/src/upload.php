<html>
<head>
  <title>SFM</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200&display=swap" rel="stylesheet">
</head>
<body>
  <div id="center">
    <?php
    function generateRandomString($length = 20) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    if(isset($_COOKIE["user"])) {
      //
    } else {
      $userid = generateRandomString();
      setcookie ("user", $userid, time() + (86400 * 30), "/");
      mkdir('files/' . $userid, 0777, true);
    }

    $target_dir = "files/";
    $target_file = $target_dir . $_COOKIE["user"] . "/" . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
        echo "<br><a href='" . $target_file . "'>View file</a>'";
      } else {
        echo "<br>Sorry, there was an error uploading your file.";
      }
    }
    ?>
  </div>
</body>
</html>
