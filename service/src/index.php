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
  setcookie("user", $userid, time() + (86400 * 30), "/");
  mkdir('files/' . $userid, 0777, true);
}
?>
<html>
<head>
  <title>SFM</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200&display=swap" rel="stylesheet">
</head>
<body>
  <div id="center">
    <h1>Superior File Manager</h1>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
      <input type="file" name="file"/>
      <br>
      <input type="submit" name="submit"/>
    </form>
  </div>
</body>
</html>
