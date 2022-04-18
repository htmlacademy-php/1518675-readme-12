<?php

print_r($_POST);
print_r($_FILES);


if (isset($_FILES['failik'])) {
    $file_name = $_FILES['failik']['name'];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;

    move_uploaded_file($_FILES['failik']['tmp_name'], $file_path . $file_name);

    print("<a href='$file_url'>$file_name</a>");

}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body class="page">
    <img src="uploads/<?= $file_name; ?>" alt="" width="300" height="300">
</body>
</html>
