<?php
session_start();
require '../conexao.php';

$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') || (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com');
if (!$isAdmin) {
    header('Location: ../login.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$role = $_POST['role'] ?? 'user';
if (!$id || !in_array($role, ['user','admin'], true)) {
    header('Location: usuarios.php');
    exit;
}

$stmt = $pdo->prepare('UPDATE usuarios SET role = :role WHERE idUsuario = :id');
$stmt->execute([':role' => $role, ':id' => $id]);

header('Location: usuarios.php?updated=1');
exit;
?>

