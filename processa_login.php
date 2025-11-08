<?php 
session_start();

include_once 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$consulta = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
$stmt = $pdo->prepare($consulta);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['idUsuario'] = $resultado['idUsuario'];
    $_SESSION['nome'] = $resultado['nome'];
    $_SESSION['email'] = $resultado['email'];

    header('Location: principal.php');
    exit;
    
} else {
    $_SESSION['erro'] = "E-mail ou senha incorretos!"; // mensagem de erro
    header('Location: login.php');
    exit;
}
?>

