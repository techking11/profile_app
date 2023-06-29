<?php

require "config.php";
$sql = "SELECT * FROM profile WHERE id=".$_GET['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetch();

if(!empty($_POST)) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];

  $img_name = $_FILES['profile']['name'];
  $img_tmp = $_FILES['profile']['tmp_name'];

  move_uploaded_file($img_tmp, "img/". $img_name);

  $sql = "UPDATE profile SET img=:img, name=:name, phone=:phone WHERE id=".$_GET['id'];
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':img' => $img_name,
    ':name' => $name,
    ':phone' => $phone
  ]);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Profile</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card profile bg-dark">
    <form action="" method="post" class="form" enctype="multipart/form-data">
      <div class="form-group profile-item">
        <label for="vw-profile">
          <img src="img/<?= $data->img; ?>" alt="Profile" class="vw-profile">
        </label>
        <input type="file" name="profile" id="vw-profile" hidden>
          <h3><input type="text" name="name" id="" value="<?= $data->name; ?>"></h3>
          <p><input type="text" name="phone" id="" value="<?= $data->phone; ?>"></p>
          <label for="send">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
          </svg>
          </label>
          <input type="submit" id="send" value="" hidden>
          <a href="index.php">
          <svg class="back-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
          </svg>
          </a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>