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
    <?php

    print_r('<h1>WORK</h1>');


    ?>

    <form action="test-upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="failik">
        <button type="submit">Отправить</button>

    </form>

</body>
</html>
