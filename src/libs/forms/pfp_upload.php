<?php
include_once __DIR__."/../../CRUD/crud_utilisateurs.php";
function upload_pfp($conn){


    $maxFileSize = 10 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $mimeToExtension = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    if (!isset($_FILES['pfp']) || $_FILES['pfp']['error'] !== UPLOAD_ERR_OK) {
        echo "1";
        return false;
    }

    if ($_FILES['pfp']['size'] > $maxFileSize) {
        echo "2";
        return false;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($_FILES['pfp']['tmp_name']);

    if (!in_array($mime, $allowedMimeTypes)) {
        echo "3";
        return false;
    }

    $dimensions = getimagesize($_FILES['pfp']['tmp_name']);
    if ($dimensions === false) {
        echo "4";
        return false;
    }

    $newFilename = $_SESSION["UserID"] . '.' . $mimeToExtension[$mime];
    $destination = __DIR__. "/../../public/img" . $newFilename;

    if (!move_uploaded_file($_FILES['pfp']['tmp_name'], $destination)) {
        echo "5";
        return false;
    }
    echo "6";

    return update_pfp($conn, $_SESSION["UserID"], "./img/pfp/".$newFilename);
}