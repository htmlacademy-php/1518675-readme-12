<?php

print_r($_POST);


if (isset($_FILES['userpic-file'])) {
    $file_name = $_FILES['userpic-file']['name'];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;

    move_uploaded_file($_FILES['userpic-file']['tmp_name'], $file_path . $file_name);
}
