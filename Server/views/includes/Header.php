<?php 
$userSession = $_SESSION['user'] ?? null; 
$urlAbsolute = $_ENV['APP_URL_ROUTE'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>M2M Managment Project</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= $urlAbsolute ?>/css/base.css">
        <link rel="stylesheet" href="<?= $urlAbsolute ?>/css/output.css">
        <link rel="icon" href="<?= $urlAbsolute ?>/assets/icons/M2M.png" type="image/png">
        <base href="<?= $urlAbsolute ?>/">
    </head>
    <body class="">