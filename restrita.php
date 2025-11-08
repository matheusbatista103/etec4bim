<?php
    session_start();


    if(  (!isset($_SESSION['id'])) and (!isset($_SESSION['nome'])) and (!isset($_SESSION['email'])) ){
        unset(
            $_SESSION['id'],
            $_SESSION['nome'],
            $_SESSION['email']
        );
        header('location: index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    BEM VINDO FULANO DE TAL
    <br>
    <br>
    <button>
        <a href="logout.php">SAIR</a>
    </button>
</body>
</html>